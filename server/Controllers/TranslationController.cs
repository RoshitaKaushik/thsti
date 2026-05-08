using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using ThstiServer.Services;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class TranslationController : ControllerBase
    {
        private readonly IBhashiniTranslationService _translationService;

        public TranslationController(IBhashiniTranslationService translationService)
        {
            _translationService = translationService;
        }

        public class TranslateRequest
        {
            public string SourceText { get; set; }
        }

        [HttpPost("translate")]
        [Authorize(Roles = "ADMIN,SUPER_ADMIN")] // Only allow CMS users to use this endpoint
        public async Task<IActionResult> Translate([FromBody] TranslateRequest request)
        {
            if (string.IsNullOrWhiteSpace(request?.SourceText))
            {
                return BadRequest("SourceText is required.");
            }

            var translatedText = await _translationService.TranslateToHindiAsync(request.SourceText);
            return Ok(new { TranslatedText = translatedText });
        }
    }
}
