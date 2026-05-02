using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.Configuration;
using System.IO;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;
using ThstiServer.Utils;
using System;

namespace ThstiServer.Middleware
{
    public class EncryptedRequestPayload
    {
        public string data { get; set; }
    }

    public class EncryptionMiddleware
    {
        private readonly RequestDelegate _next;
        private readonly CryptoHelper _cryptoHelper;

        public EncryptionMiddleware(RequestDelegate next, IConfiguration config)
        {
            _next = next;
            var key = config["Encryption:Key"];
            _cryptoHelper = new CryptoHelper(key ?? "@Thsti#SecureKey_2026!");
        }

        public async Task InvokeAsync(HttpContext context)
        {
            // Skip swagger and crypto test tools to prevent breaking development, but DO encrypt/decrypt login!
            if (context.Request.Path.StartsWithSegments("/swagger") || 
                context.Request.Path.StartsWithSegments("/api/crypto"))
            {
                await _next(context);
                return;
            }

            // 1. Intercept Request (Decrypt POST/PUT data)
            bool isJsonRequest = context.Request.ContentType != null && context.Request.ContentType.Contains("application/json", StringComparison.OrdinalIgnoreCase);
            if (isJsonRequest && (context.Request.Method == HttpMethods.Post || context.Request.Method == HttpMethods.Put) && context.Request.ContentLength > 0)
            {
                context.Request.EnableBuffering();
                using var reader = new StreamReader(context.Request.Body, Encoding.UTF8, leaveOpen: true);
                var rawBody = await reader.ReadToEndAsync();
                context.Request.Body.Position = 0; 

                if (!string.IsNullOrEmpty(rawBody))
                {
                    try
                    {
                        var payload = JsonSerializer.Deserialize<EncryptedRequestPayload>(rawBody);
                        if (payload != null && !string.IsNullOrEmpty(payload.data))
                        {
                            var decryptedJson = _cryptoHelper.Decrypt(payload.data);
                            if (!string.IsNullOrEmpty(decryptedJson))
                            {
                                // Replace incoming body with decrypted JSON
                                var requestData = Encoding.UTF8.GetBytes(decryptedJson);
                                var newStream = new MemoryStream(requestData);
                                context.Request.Body = newStream;
                                context.Request.ContentLength = requestData.Length;
                            }
                        }
                    }
                    catch (Exception)
                    {
                        // Proceed normally if not structured payload
                    }
                }
            }

            // 2. Intercept Response (Encrypt Outgoing data)
            var originalBodyStream = context.Response.Body;
            using var responseBody = new MemoryStream();
            context.Response.Body = responseBody;

            await _next(context); 

            context.Response.Body = originalBodyStream; 

            responseBody.Seek(0, SeekOrigin.Begin);
            string rawOutput = await new StreamReader(responseBody).ReadToEndAsync();

            bool isJson = context.Response.ContentType != null && context.Response.ContentType.Contains("application/json");

            if ((context.Response.StatusCode == 200 || context.Response.StatusCode == 201) && !string.IsNullOrEmpty(rawOutput) && isJson)
            {
                var encryptedData = _cryptoHelper.Encrypt(rawOutput);
                
                var wrappedResponse = new {
                    status = context.Response.StatusCode,
                    message = "Success",
                    data = encryptedData
                };

                var wrappedJson = JsonSerializer.Serialize(wrappedResponse);
                
                // Clear existing content length since our wrapped JSON will be a different size Let ASP.NET re-calculate it
                context.Response.ContentLength = null;
                await context.Response.WriteAsync(wrappedJson, Encoding.UTF8);
            }
            else if (!string.IsNullOrEmpty(rawOutput) && isJson)
            {
                 var wrappedResponse = new {
                    status = context.Response.StatusCode,
                    message = rawOutput, // Optional: put raw error message here
                    data = (string)null
                };
                var wrappedJson = JsonSerializer.Serialize(wrappedResponse);
                context.Response.ContentLength = null;
                await context.Response.WriteAsync(wrappedJson, Encoding.UTF8);
            }
            else
            {
                // Unhandled format or empty
                responseBody.Seek(0, SeekOrigin.Begin);
                await responseBody.CopyToAsync(originalBodyStream);
            }
        }
    }
}
