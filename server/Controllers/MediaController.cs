using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using Microsoft.AspNetCore.Authorization;
using System.IO;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/media")]
    public class MediaController : ControllerBase
    {
        private readonly ThstiDbContext _context;
        private readonly ThstiServer.Services.ICloudStorageService _cloudStorage;

        public MediaController(ThstiDbContext context, ThstiServer.Services.ICloudStorageService cloudStorage)
        {
            _context = context;
            _cloudStorage = cloudStorage;
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPost("upload")]
        public async Task<IActionResult> UploadMedia([FromForm] IFormFile file, [FromForm] string? altText)
        {
            if (file == null || file.Length == 0)
                return BadRequest(new { error = "No file uploaded or invalid file format" });

            try
            {
                var cloudVaultUrl = await _cloudStorage.UploadFileAsync(file, "thsti-vault");

                var media = new Medium
                {
                    Filename = file.FileName,
                    Url = cloudVaultUrl,
                    StoragePath = "CLOUD_VAULT",
                    MimeType = file.ContentType,
                    Size = (int)file.Length,
                    AltText = altText,
                    CreatedAt = DateTime.UtcNow
                };

                _context.Media.Add(media);
                await _context.SaveChangesAsync();

                return StatusCode(201, media);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { error = "Failed to upload media", details = ex.Message });
            }
        }

        [HttpGet]
        public async Task<IActionResult> GetMedia()
        {
            var media = await _context.Media.OrderByDescending(m => m.CreatedAt).ToListAsync();
            return Ok(media);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpDelete("{id:int}")]
        public async Task<IActionResult> DeleteMedia(int id)
        {
            var media = await _context.Media.FindAsync(id);
            if (media == null) return NotFound(new { error = "Media not found" });

            try
            {
                await _cloudStorage.DeleteFileAsync(media.Url, "thsti-vault");
            }
            catch { /* Ignore cloud cleanup errors so DB unbinds */ }

            _context.Media.Remove(media);
            await _context.SaveChangesAsync();
            return NoContent();
        }
    }
}
