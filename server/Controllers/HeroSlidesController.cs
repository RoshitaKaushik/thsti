using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using ThstiServer.DTOs;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System;
using System.Threading.Tasks;
using System.Security.Claims;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/hero-slides")]
    public class HeroSlidesController : ControllerBase
    {
        private readonly ThstiDbContext _context;
        private readonly ThstiServer.Services.ITranslationService _translationService;

        public HeroSlidesController(ThstiDbContext context, ThstiServer.Services.ITranslationService translationService)
        {
            _context = context;
            _translationService = translationService;
        }

        [HttpGet("public")]
        public async Task<IActionResult> GetPublicHeroSlides()
        {
            var slides = await _context.HeroSlides
                .Where(s => s.IsActive && s.ReviewStatus == "Published" && !s.IsArchived)
                .OrderBy(s => s.DisplayOrder)
                .ToListAsync();
            return Ok(slides);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpGet("all")]
        public async Task<IActionResult> GetAllHeroSlides()
        {
            var slides = await _context.HeroSlides
                .OrderBy(s => s.DisplayOrder)
                .ToListAsync();
            return Ok(slides);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPost]
        public async Task<IActionResult> CreateHeroSlide([FromBody] HeroSlideRequest req)
        {
            using var transaction = await _context.Database.BeginTransactionAsync();
            try
            {
                if (req.IsActiveVideo)
                {
                    var activeVideos = await _context.HeroSlides.Where(s => s.IsActiveVideo).ToListAsync();
                    foreach (var video in activeVideos) video.IsActiveVideo = false;
                }

                var userRole = User.FindFirst(ClaimTypes.Role)?.Value ?? "VIEWER";
                var status = req.ReviewStatus ?? "Draft";
                // Executives cannot straight publish
                if (userRole == "EXECUTIVE" && status == "Published")
                {
                    status = "PendingReview";
                }

                var titleHi = req.TitleHi;
                if (string.IsNullOrWhiteSpace(titleHi) && !string.IsNullOrWhiteSpace(req.Title))
                    titleHi = await _translationService.TranslateToHindiAsync(req.Title);
                    
                var subtitleHi = req.SubtitleHi;
                if (string.IsNullOrWhiteSpace(subtitleHi) && !string.IsNullOrWhiteSpace(req.Subtitle))
                    subtitleHi = await _translationService.TranslateToHindiAsync(req.Subtitle);

                var slide = new HeroSlide
                {
                    Title = req.Title,
                    TitleHi = titleHi,
                    Subtitle = req.Subtitle,
                    SubtitleHi = subtitleHi,
                    Type = req.Type ?? "IMAGE",
                    MediaUrl = req.MediaUrl,
                    PosterUrl = req.PosterUrl,
                    DisplayOrder = req.DisplayOrder,
                    IsActive = req.IsActive,
                    IsActiveVideo = req.IsActiveVideo,
                    OpenInNewTab = req.OpenInNewTab,
                    RouteUrl = req.RouteUrl,
                    ShowText = req.ShowText,
                    ReviewStatus = status,
                    Remarks = req.Remarks,
                    CreatedAt = DateTime.UtcNow,
                    UpdatedAt = DateTime.UtcNow
                };

                _context.HeroSlides.Add(slide);
                await _context.SaveChangesAsync();
                await transaction.CommitAsync();

                return CreatedAtAction(nameof(GetAllHeroSlides), new { id = slide.Id }, slide);
            }
            catch (Exception ex)
            {
                await transaction.RollbackAsync();
                return StatusCode(500, new { error = "Failed to create hero slide", details = ex.Message });
            }
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut("{id:int}")]
        public async Task<IActionResult> UpdateHeroSlide(int id, [FromBody] HeroSlideRequest req)
        {
            using var transaction = await _context.Database.BeginTransactionAsync();
            try
            {
                var slide = await _context.HeroSlides.FindAsync(id);
                if (slide == null) return NotFound(new { error = "Not found" });

                if (req.IsActiveVideo)
                {
                    var activeVideos = await _context.HeroSlides.Where(s => s.IsActiveVideo && s.Id != id).ToListAsync();
                    foreach (var video in activeVideos) video.IsActiveVideo = false;
                }

                var userRole = User.FindFirst(ClaimTypes.Role)?.Value ?? "VIEWER";
                var status = req.ReviewStatus ?? slide.ReviewStatus;
                
                // Executives cannot bypass workflow
                if (userRole == "EXECUTIVE" && status == "Published" && slide.ReviewStatus != "Published")
                {
                    status = "PendingReview";
                }

                var titleHi = req.TitleHi;
                if (string.IsNullOrWhiteSpace(titleHi) && !string.IsNullOrWhiteSpace(req.Title))
                    titleHi = await _translationService.TranslateToHindiAsync(req.Title);
                    
                var subtitleHi = req.SubtitleHi;
                if (string.IsNullOrWhiteSpace(subtitleHi) && !string.IsNullOrWhiteSpace(req.Subtitle))
                    subtitleHi = await _translationService.TranslateToHindiAsync(req.Subtitle);

                slide.Title = req.Title;
                slide.TitleHi = titleHi;
                slide.Subtitle = req.Subtitle;
                slide.SubtitleHi = subtitleHi;
                slide.Type = req.Type ?? "IMAGE";
                slide.MediaUrl = req.MediaUrl;
                slide.PosterUrl = req.PosterUrl;
                slide.DisplayOrder = req.DisplayOrder;
                slide.IsActive = req.IsActive;
                slide.IsArchived = req.IsArchived;
                slide.IsActiveVideo = req.IsActiveVideo;
                slide.OpenInNewTab = req.OpenInNewTab;
                slide.RouteUrl = req.RouteUrl;
                slide.ShowText = req.ShowText;
                slide.ReviewStatus = status;
                slide.Remarks = req.Remarks ?? slide.Remarks;
                slide.UpdatedAt = DateTime.UtcNow;

                await _context.SaveChangesAsync();
                await transaction.CommitAsync();

                return Ok(slide);
            }
            catch (Exception ex)
            {
                await transaction.RollbackAsync();
                return StatusCode(500, new { error = "Failed to update hero slide", details = ex.Message });
            }
        }

        [Authorize(Roles = "ADMIN,MANAGER")]
        [HttpDelete("{id:int}")]
        public async Task<IActionResult> DeleteHeroSlide(int id)
        {
            var slide = await _context.HeroSlides.FindAsync(id);
            if (slide == null) return NotFound();

            _context.HeroSlides.Remove(slide);
            await _context.SaveChangesAsync();
            return NoContent();
        }

        [Authorize(Roles = "ADMIN,MANAGER")]
        [HttpPatch("{id:int}/toggle-active")]
        public async Task<IActionResult> ToggleHeroSlideActive(int id)
        {
            var slide = await _context.HeroSlides.FindAsync(id);
            if (slide == null) return NotFound(new { error = "Hero slide not found" });

            slide.IsActive = !slide.IsActive;
            slide.UpdatedAt = DateTime.UtcNow;
            await _context.SaveChangesAsync();

            return Ok(slide);
        }

        [Authorize(Roles = "ADMIN,MANAGER")]
        [HttpPatch("reorder")]
        public async Task<IActionResult> UpdateHeroSlideOrder([FromBody] ReorderRequest req)
        {
            if (req.Items == null || !req.Items.Any()) return BadRequest(new { error = "Invalid items payload" });

            using var transaction = await _context.Database.BeginTransactionAsync();
            try
            {
                foreach (var item in req.Items)
                {
                    var slide = await _context.HeroSlides.FindAsync(item.Id);
                    if (slide != null)
                    {
                        slide.DisplayOrder = item.Order;
                    }
                }
                await _context.SaveChangesAsync();
                await transaction.CommitAsync();

                return Ok(new { message = "Order updated successfully" });
            }
            catch (Exception ex)
            {
                await transaction.RollbackAsync();
                return StatusCode(500, new { error = "Failed to update order" });
            }
        }
    }
}
