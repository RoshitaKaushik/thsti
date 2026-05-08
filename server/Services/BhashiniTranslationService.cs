using System.Net.Http;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.Logging;

namespace ThstiServer.Services
{
    public interface IBhashiniTranslationService
    {
        Task<string> TranslateToHindiAsync(string sourceText);
    }

    public class BhashiniTranslationService : IBhashiniTranslationService
    {
        private readonly HttpClient _httpClient;
        private readonly IConfiguration _configuration;
        private readonly ILogger<BhashiniTranslationService> _logger;
        private const string INFERENCE_URL = "https://dhruva-api.bhashini.gov.in/services/inference/pipeline";

        public BhashiniTranslationService(HttpClient httpClient, IConfiguration configuration, ILogger<BhashiniTranslationService> logger)
        {
            _httpClient = httpClient;
            _configuration = configuration;
            _logger = logger;
        }

        public async Task<string> TranslateToHindiAsync(string sourceText)
        {
            if (string.IsNullOrWhiteSpace(sourceText)) return sourceText;

            var apiKey = _configuration["Bhashini:ApiKey"];
            var userId = _configuration["Bhashini:UserId"];

            if (string.IsNullOrEmpty(apiKey) || string.IsNullOrEmpty(userId))
            {
                _logger.LogWarning("Bhashini API Key or User ID is not configured. Skipping translation.");
                return sourceText; // Fallback
            }

            try
            {
                var payload = new
                {
                    pipelineTasks = new[]
                    {
                        new
                        {
                            taskType = "translation",
                            config = new
                            {
                                language = new
                                {
                                    sourceLanguage = "en",
                                    targetLanguage = "hi"
                                }
                            }
                        }
                    },
                    inputData = new
                    {
                        input = new[]
                        {
                            new { source = sourceText }
                        }
                    }
                };

                var jsonPayload = JsonSerializer.Serialize(payload);
                var content = new StringContent(jsonPayload, Encoding.UTF8, "application/json");

                var request = new HttpRequestMessage(HttpMethod.Post, INFERENCE_URL);
                request.Headers.Add("Authorization", apiKey);
                request.Headers.Add("userID", userId);
                request.Content = content;

                var response = await _httpClient.SendAsync(request);
                response.EnsureSuccessStatusCode();

                var responseString = await response.Content.ReadAsStringAsync();
                using var document = JsonDocument.Parse(responseString);
                
                var root = document.RootElement;
                if (root.TryGetProperty("pipelineResponse", out var pipelineResponse) && pipelineResponse.GetArrayLength() > 0)
                {
                    var output = pipelineResponse[0].GetProperty("output");
                    if (output.GetArrayLength() > 0)
                    {
                        var target = output[0].GetProperty("target").GetString();
                        if (!string.IsNullOrEmpty(target))
                        {
                            return target;
                        }
                    }
                }

                return sourceText;
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Failed to translate text using Bhashini API.");
                return sourceText;
            }
        }
    }
}
