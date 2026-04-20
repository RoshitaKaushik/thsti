using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.Logging;
using System.Linq;
using System.Net;
using System.Threading.Tasks;

namespace ThstiServer.Middleware
{
    public class IpWhitelistMiddleware
    {
        private readonly RequestDelegate _next;
        private readonly IConfiguration _configuration;
        private readonly ILogger<IpWhitelistMiddleware> _logger;

        public IpWhitelistMiddleware(RequestDelegate next, IConfiguration configuration, ILogger<IpWhitelistMiddleware> logger)
        {
            _next = next;
            _configuration = configuration;
            _logger = logger;
        }

        public async Task Invoke(HttpContext context)
        {
            if (context.Request.Path.StartsWithSegments("/api/admin"))
            {
                var remoteIp = context.Connection.RemoteIpAddress;
                _logger.LogInformation("Request from Remote IP address: {RemoteIp}", remoteIp);

                var whitelistedIps = _configuration.GetSection("AdminIpWhitelist").Get<string[]>() ?? new string[] { "127.0.0.1", "::1" };
                
                var isWhitelisted = remoteIpsContains(whitelistedIps, remoteIp);

                if (!isWhitelisted)
                {
                    _logger.LogWarning("Forbidden Request from Remote IP address: {RemoteIp}", remoteIp);
                    context.Response.StatusCode = (int)HttpStatusCode.Forbidden;
                    await context.Response.WriteAsync("403 Forbidden: IP not authorized for administrative modules.");
                    return;
                }
            }

            await _next(context);
        }

        private bool remoteIpsContains(string[] whitelistedIps, IPAddress remoteIp)
        {
            if (remoteIp == null) return false;
            
            // Convert everything to string for simplicity in this implementation
            var remoteIpString = remoteIp.ToString();
            
            // Check exact matches or simplified logic for IPv6 localhost
            if (whitelistedIps.Contains(remoteIpString)) return true;
            if (remoteIp.IsIPv4MappedToIPv6 && whitelistedIps.Contains(remoteIp.MapToIPv4().ToString())) return true;
            
            return false;
        }
    }
}
