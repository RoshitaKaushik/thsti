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
        [RequestSizeLimit(524288000)] // 500 MB Limit
        [RequestFormLimits(MultipartBodyLengthLimit = 524288000)] // 500 MB Limit
        public async Task<IActionResult> UploadMedia([FromForm] IFormFile file, [FromForm] string? altText)
        {
            if (file == null || file.Length == 0)
                return BadRequest(new { error = "No file uploaded or invalid file format" });

            // GIGW Strict MIME-type and extension validation
            var allowedExtensions = new[] { ".jpg", ".jpeg", ".png", ".gif", ".webp", ".pdf", ".doc", ".docx", ".xls", ".xlsx", ".mp4" };
            var allowedMimeTypes = new[] { "image/jpeg", "image/png", "image/gif", "image/webp", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "video/mp4" };
            
            var extension = Path.GetExtension(file.FileName).ToLowerInvariant();
            if (!allowedExtensions.Contains(extension) || !allowedMimeTypes.Contains(file.ContentType.ToLowerInvariant()))
            {
                return BadRequest(new { error = "Invalid file type for security reasons. Uploads are restricted to images, PDFs, standard documents, and mp4." });
            }

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
        [HttpDelete("{id:long}")]
        public async Task<IActionResult> DeleteMedia(long id)
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

