using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;
using ThstiServer.Utils;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/crypto")]
    public class CryptoTestController : ControllerBase
    {
        private readonly CryptoHelper _cryptoHelper;

        public CryptoTestController(IConfiguration config)
        {
            var key = config["Encryption:Key"] ?? "@Thsti#SecureKey_2026!";
            _cryptoHelper = new CryptoHelper(key);
        }

        public class EncryptRequest {
            public string plainText { get; set; }
        }

        [HttpPost("decrypt")]
        public IActionResult DecryptPayload([FromBody] ThstiServer.Middleware.EncryptedRequestPayload req)
        {
            if (string.IsNullOrEmpty(req.data)) return BadRequest("Provide a valid 'data' property containing the encrypted string.");
            
            var decrypted = _cryptoHelper.Decrypt(req.data);
            if (decrypted == null) return BadRequest("Could not decrypt. Invalid string or mismatched key.");

            // Return as plain text because our EncryptionMiddleware wraps strictly JSON outputs
            return Content(decrypted, "text/plain");
        }

        [HttpPost("encrypt")]
        public IActionResult EncryptPayload([FromBody] EncryptRequest req)
        {
            if (string.IsNullOrEmpty(req.plainText)) return BadRequest("Provide plainText.");
            
            var encrypted = _cryptoHelper.Encrypt(req.plainText);
            return Content(encrypted, "text/plain");
        }
    }
}
