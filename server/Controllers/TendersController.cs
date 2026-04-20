using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System;
using System.Threading.Tasks;
using System.Security.Claims;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/tenders")]
    public class TendersController : ControllerBase
    {
        private readonly ThstiDbContext _context;
        private readonly ThstiServer.Services.ITranslationService _translationService;

        public TendersController(ThstiDbContext context, ThstiServer.Services.ITranslationService translationService)
        {
            _context = context;
            _translationService = translationService;
        }

        [HttpGet("public")]
        public async Task<IActionResult> GetPublic()
        {
            var items = await _context.Tenders
                .Where(x => x.ReviewStatus == "Published" && !x.IsArchived)
                .OrderByDescending(x => x.PublishDate)
                .ToListAsync();
            return Ok(items);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpGet("admin")]
        public async Task<IActionResult> GetAllAdmin()
        {
            var userRole = User.Claims.FirstOrDefault(c => c.Type == ClaimTypes.Role)?.Value;

            IQueryable<Tender> query = _context.Tenders;

            // Executives can only see their drafts or statuses relevant to them for edits
            if (userRole == "EXECUTIVE")
            {
                query = query.Where(x => x.ReviewStatus != "Published");
            }

            var items = await query.OrderByDescending(x => x.CreatedAt).ToListAsync();
            return Ok(items);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPost]
        public async Task<IActionResult> Create([FromBody] TenderReq req)
        {
            var userRole = User.Claims.FirstOrDefault(c => c.Type == ClaimTypes.Role)?.Value;
            var status = req.ReviewStatus ?? "Draft";

            if (userRole == "EXECUTIVE" && status == "Published")
            {
                status = "PendingReview";
            }

            var titleHi = req.TitleHi;
            if (string.IsNullOrWhiteSpace(titleHi) && !string.IsNullOrWhiteSpace(req.Title))
                titleHi = await _translationService.TranslateToHindiAsync(req.Title);

            var item = new Tender
            {
                Title = req.Title,
                TitleHi = titleHi,
                ReferenceNo = req.ReferenceNo,
                DocumentUrl = req.DocumentUrl,
                PublishDate = req.PublishDate,
                ClosingDate = req.ClosingDate,
                ReviewStatus = status,
                Remarks = req.Remarks,
                IsArchived = false,
                CreatedAt = DateTime.UtcNow,
                UpdatedAt = DateTime.UtcNow
            };

            _context.Tenders.Add(item);
            await _context.SaveChangesAsync();
            return StatusCode(201, item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut("{id:int}")]
        public async Task<IActionResult> Update(int id, [FromBody] TenderReq req)
        {
            var item = await _context.Tenders.FindAsync(id);
            if (item == null) return NotFound();

            var userRole = User.Claims.FirstOrDefault(c => c.Type == ClaimTypes.Role)?.Value;
            var status = req.ReviewStatus ?? item.ReviewStatus;

            if (userRole == "EXECUTIVE" && status == "Published")
            {
                status = "PendingReview";
            }

            var titleHi = req.TitleHi;
            if (string.IsNullOrWhiteSpace(titleHi) && !string.IsNullOrWhiteSpace(req.Title))
                titleHi = await _translationService.TranslateToHindiAsync(req.Title);

            item.Title = req.Title;
            item.TitleHi = titleHi;
            item.ReferenceNo = req.ReferenceNo;
            item.DocumentUrl = req.DocumentUrl;
            item.PublishDate = req.PublishDate;
            item.ClosingDate = req.ClosingDate;
            item.ReviewStatus = status;
            item.Remarks = req.Remarks;
            item.IsArchived = req.IsArchived;
            item.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();
            return Ok(item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpDelete("{id:int}")]
        public async Task<IActionResult> Delete(int id)
        {
            var item = await _context.Tenders.FindAsync(id);
            if (item == null) return NotFound();

            _context.Tenders.Remove(item);
            await _context.SaveChangesAsync();
            return NoContent();
        }
    }

    public class TenderReq
    {
        public string Title { get; set; } = string.Empty;
        public string? TitleHi { get; set; }
        public string ReferenceNo { get; set; } = string.Empty;
        public string DocumentUrl { get; set; } = string.Empty;
        public DateTime PublishDate { get; set; }
        public DateTime ClosingDate { get; set; }
        public string? ReviewStatus { get; set; }
        public string? Remarks { get; set; }
        public bool IsArchived { get; set; }
    }
}
