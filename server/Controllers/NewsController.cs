using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System;
using System.Security.Claims;
using System.Threading.Tasks;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/news")]
    public class NewsController : ControllerBase
    {
        private readonly ThstiDbContext _context;
        private readonly ThstiServer.Services.ITranslationService _translationService;

        public NewsController(ThstiDbContext context, ThstiServer.Services.ITranslationService translationService)
        {
            _context = context;
            _translationService = translationService;
        }

        [HttpGet]
        public async Task<IActionResult> GetAll()
        {
            var items = await _context.News
                .Where(n => n.IsActive && n.ReviewStatus == "Published" && !n.IsArchived)
                .ToListAsync();
            return Ok(items);
        }

        [HttpGet("public")]
        public async Task<IActionResult> GetPublic([FromQuery] int? limit = null)
        {
            var query = _context.News
                .Where(n => n.IsActive && n.ReviewStatus == "Published" && !n.IsArchived)
                .OrderByDescending(n => n.PublishDate);
                
            var resultQuery = limit.HasValue ? query.Take(limit.Value) : query;
            var items = await resultQuery.ToListAsync();
            return Ok(items);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpGet("all")]
        public async Task<IActionResult> GetAllAdmin()
        {
            var items = await _context.News.ToListAsync();
            return Ok(items);
        }

        [HttpGet("{id:long}")]
        public async Task<IActionResult> GetById(long id)
        {
            var item = await _context.News.FindAsync(id);
            if (item == null) return NotFound();
            return Ok(item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPost]
        public async Task<IActionResult> Create([FromBody] News item)
        {
            var userRole = User.FindFirst(ClaimTypes.Role)?.Value ?? "VIEWER";
            var status = item.ReviewStatus ?? "Draft";
            if (userRole == "EXECUTIVE" && status == "Published")
            {
                status = "PendingReview";
            }
            item.ReviewStatus = status;

            if (string.IsNullOrWhiteSpace(item.TitleHi))
            {
                item.TitleHi = await _translationService.TranslateToHindiAsync(item.Title);
            }
            if (!string.IsNullOrWhiteSpace(item.Content) && string.IsNullOrWhiteSpace(item.ContentHi))
            {
                // Note: Translating HTML blocks directly via query param Google Translate may break tags.
                // In production with Bhashini, proper tag parsing will be required.
                item.ContentHi = await _translationService.TranslateToHindiAsync(item.Content);
            }

            item.CreatedAt = DateTime.UtcNow;
            item.UpdatedAt = DateTime.UtcNow;
            _context.News.Add(item);
            await _context.SaveChangesAsync();
            return StatusCode(201, item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut("{id:long}")]
        public async Task<IActionResult> Update(long id, [FromBody] News updatedItem)
        {
            var item = await _context.News.FindAsync(id);
            if (item == null) return NotFound();

            var userRole = User.FindFirst(ClaimTypes.Role)?.Value ?? "VIEWER";
            var status = updatedItem.ReviewStatus ?? item.ReviewStatus;
            
            // Executives cannot bypass workflow
            if (userRole == "EXECUTIVE" && status == "Published" && item.ReviewStatus != "Published")
            {
                status = "PendingReview";
            }
            updatedItem.ReviewStatus = status;

            if (string.IsNullOrWhiteSpace(updatedItem.TitleHi))
            {
                updatedItem.TitleHi = await _translationService.TranslateToHindiAsync(updatedItem.Title);
            }
            if (!string.IsNullOrWhiteSpace(updatedItem.Content) && string.IsNullOrWhiteSpace(updatedItem.ContentHi))
            {
                updatedItem.ContentHi = await _translationService.TranslateToHindiAsync(updatedItem.Content);
            }

            _context.Entry(item).CurrentValues.SetValues(updatedItem);
            item.Id = id; 
            item.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();
            return Ok(item);
        }

        [Authorize(Roles = "ADMIN,MANAGER")]
        [HttpDelete("{id:long}")]
        public async Task<IActionResult> Delete(long id)
        {
            var item = await _context.News.FindAsync(id);
            if (item == null) return NotFound();

            _context.News.Remove(item);
            await _context.SaveChangesAsync();
            return NoContent();
        }

        [HttpGet("slug/{slug}")]
        public async Task<IActionResult> GetBySlug(string slug)
        {
            var item = await _context.News.FirstOrDefaultAsync(x => x.Slug == slug);
            if (item == null) return NotFound();
            return Ok(item);
        }

    }
}

