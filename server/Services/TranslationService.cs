using System;
using System.Net.Http;
using System.Text.Json;
using System.Threading.Tasks;

namespace ThstiServer.Services
{
    public interface ITranslationService
    {
        Task<string> TranslateToHindiAsync(string text);
    }

    /// <summary>
    /// Phase 3 Mock Translation Service via Unofficial Google Translate API Endpoint.
    /// This is a fallback integration explicitly designed to be swapped out for the official NIC Bhashini API once API tokens are issued.
    /// </summary>
    public class GoogleTranslationFallbackService : ITranslationService
    {
        private readonly HttpClient _httpClient;

        public GoogleTranslationFallbackService(HttpClient httpClient)
        {
            _httpClient = httpClient;
        }

        public async Task<string> TranslateToHindiAsync(string text)
        {
            if (string.IsNullOrWhiteSpace(text)) return string.Empty;

            try
            {
                var encodedText = Uri.EscapeDataString(text);
                var url = $"https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=hi&dt=t&q={encodedText}";
                
                var response = await _httpClient.GetStringAsync(url);
                // Response format is extremely nested: [[[ "translated_text", "original_text", ...]]]
                using var jsonDoc = JsonDocument.Parse(response);
                var root = jsonDoc.RootElement;
                
                if (root.ValueKind == JsonValueKind.Array && root.GetArrayLength() > 0)
                {
                    var translations = root[0];
                    if (translations.ValueKind == JsonValueKind.Array && translations.GetArrayLength() > 0)
                    {
                        var translatedTextPart = translations[0];
                        if (translatedTextPart.ValueKind == JsonValueKind.Array && translatedTextPart.GetArrayLength() > 0)
                        {
                            return translatedTextPart[0].GetString() ?? text;
                        }
                    }
                }
                return text;
            }
            catch (Exception)
            {
                // Fallback gracefully on fail
                return text;
            }
        }
    }
}
