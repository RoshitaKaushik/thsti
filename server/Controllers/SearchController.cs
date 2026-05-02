using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using System.Linq;
using System.Threading.Tasks;
using System.Text.RegularExpressions;
using System;
using System.Collections.Generic;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/search")]
    public class SearchController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public SearchController(ThstiDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> Search([FromQuery] string q)
        {
            if (string.IsNullOrEmpty(q))
            {
                return Ok(new List<object>());
            }

            var queryLower = q.ToLower();

            var pages = await _context.Pages
                .Where(p => p.IsActive && 
                           (p.Title.ToLower().Contains(queryLower) || 
                            p.Content.ToLower().Contains(queryLower)))
                .Select(p => new { p.Title, p.Slug, p.Content })
                .ToListAsync();

            var news = await _context.News
                .Where(n => n.IsActive && 
                           (n.Title.ToLower().Contains(queryLower) || 
                            n.Content.ToLower().Contains(queryLower)))
                .Select(n => new { n.Title, n.Slug, n.Content })
                .ToListAsync();

            var tenders = await _context.Tenders
                .Where(t => !t.IsArchived && 
                           (t.Title.ToLower().Contains(queryLower) || 
                            t.ReferenceNo.ToLower().Contains(queryLower)))
                .Select(t => new { t.Title, t.ReferenceNo })
                .ToListAsync();

            var faculties = await _context.Faculties
                .Where(f => f.IsActive && !f.IsArchived && 
                           (f.Name.ToLower().Contains(queryLower) || 
                            (f.Designation != null && f.Designation.ToLower().Contains(queryLower)) || 
                            (f.ResearchFocus != null && f.ResearchFocus.ToLower().Contains(queryLower))))
                .Select(f => new { f.Name, f.Slug, f.Designation, f.ResearchFocus })
                .ToListAsync();

            var researchCenters = await _context.ResearchCenters
                .Where(r => r.IsActive && 
                           (r.Title.ToLower().Contains(queryLower) || 
                            (r.Content != null && r.Content.ToLower().Contains(queryLower))))
                .Select(r => new { r.Title, r.Slug, r.Content })
                .ToListAsync();

            var researchFacilities = await _context.ResearchFacilities
                .Where(r => r.IsActive && 
                           (r.Title.ToLower().Contains(queryLower) || 
                            (r.Content != null && r.Content.ToLower().Contains(queryLower))))
                .Select(r => new { r.Title, r.Slug, r.Content })
                .ToListAsync();

            var events = await _context.Notifications
                .Where(n => n.IsActive && 
                           (n.Title.ToLower().Contains(queryLower) || 
                            (n.Summary != null && n.Summary.ToLower().Contains(queryLower))))
                .Select(n => new { n.Title, n.Url, n.Summary })
                .ToListAsync();

            var results = new List<object>();

            foreach (var p in pages)
            {
                results.Add(new
                {
                    type = "Page",
                    title = p.Title,
                    url = $"/pages/{p.Slug}",
                    snippet = GetSnippet(p.Content)
                });
            }

            foreach (var n in news)
            {
                results.Add(new
                {
                    type = "News",
                    title = n.Title,
                    url = $"/news/{n.Slug}",
                    snippet = GetSnippet(n.Content)
                });
            }

            foreach (var t in tenders)
            {
                results.Add(new
                {
                    type = "Tender",
                    title = t.Title,
                    url = "/Tender",
                    snippet = t.ReferenceNo
                });
            }

            foreach (var f in faculties)
            {
                var combinedSnippet = "";
                if (!string.IsNullOrEmpty(f.Designation)) combinedSnippet += f.Designation;
                if (!string.IsNullOrEmpty(f.ResearchFocus)) combinedSnippet += string.IsNullOrEmpty(combinedSnippet) ? f.ResearchFocus : $" - {f.ResearchFocus}";
                
                results.Add(new
                {
                    type = "Faculty",
                    title = f.Name,
                    url = $"/faculty/{f.Slug}",
                    snippet = combinedSnippet
                });
            }

            foreach (var r in researchCenters)
            {
                results.Add(new
                {
                    type = "Research Center",
                    title = r.Title,
                    url = $"/research-centers/{r.Slug}",
                    snippet = GetSnippet(r.Content)
                });
            }

            foreach (var r in researchFacilities)
            {
                results.Add(new
                {
                    type = "Facility",
                    title = r.Title,
                    url = $"/research-facilities/{r.Slug}",
                    snippet = GetSnippet(r.Content)
                });
            }

            foreach (var e in events)
            {
                results.Add(new
                {
                    type = "Event / Notification",
                    title = e.Title,
                    url = string.IsNullOrEmpty(e.Url) ? "#" : e.Url,
                    snippet = GetSnippet(e.Summary)
                });
            }

            return Ok(results);
        }

        private string GetSnippet(string content)
        {
            if (string.IsNullOrEmpty(content)) return "";
            var textOnly = Regex.Replace(content, "<[^>]+>", " ").Trim();
            return textOnly.Length > 150 ? textOnly.Substring(0, 150) + "..." : textOnly;
        }
    }
}
