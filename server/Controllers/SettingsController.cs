using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using ThstiServer.DTOs;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System;
using System.Threading.Tasks;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/settings")]
    public class SettingsController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public SettingsController(ThstiDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> GetSettings()
        {
            var settings = await _context.GlobalSettings.OrderByDescending(s => s.Id).FirstOrDefaultAsync();
            if (settings == null)
            {
                settings = new GlobalSetting
                {
                    SiteName = "THSTI CMS",
                    CreatedAt = DateTime.UtcNow,
                    UpdatedAt = DateTime.UtcNow
                };
                _context.GlobalSettings.Add(settings);
                await _context.SaveChangesAsync();
            }

            return Ok(settings);
        }

        [HttpGet("last-updated")]
        public async Task<IActionResult> GetLastUpdated()
        {
            try
            {
                var pageMax = await _context.Pages.MaxAsync(p => (DateTime?)p.UpdatedAt) ?? DateTime.MinValue;
                var newsMax = await _context.News.MaxAsync(n => (DateTime?)n.UpdatedAt) ?? DateTime.MinValue;
                var tendersMax = await _context.Tenders.MaxAsync(t => (DateTime?)t.UpdatedAt) ?? DateTime.MinValue;
                var maxDate = new[] { pageMax, newsMax, tendersMax }.Max();

                if (maxDate == DateTime.MinValue) maxDate = DateTime.UtcNow;

                return Ok(new { lastUpdated = maxDate });
            }
            catch
            {
                return Ok(new { lastUpdated = DateTime.UtcNow });
            }
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut]
        public async Task<IActionResult> UpdateSettings([FromBody] SettingsRequest req)
        {
            try
            {
                var userName = User.FindFirst("name")?.Value ?? User.FindFirst(System.Security.Claims.ClaimTypes.Email)?.Value ?? "System";
                var settings = await _context.GlobalSettings.OrderByDescending(s => s.Id).FirstOrDefaultAsync();
                
                if (settings == null)
                {
                    settings = new GlobalSetting
                    {
                        CreatedAt = DateTime.UtcNow,
                        CreatedBy = userName
                    };
                    _context.GlobalSettings.Add(settings);
                }

                settings.SiteName = req.SiteName;
                settings.LogoUrl = req.LogoUrl;
                settings.ContactEmail = req.ContactEmail;
                settings.ContactPhone = req.ContactPhone;
                settings.Address = req.Address;
                settings.MapLink = req.MapLink;
                settings.FooterImageUrl = req.FooterImageUrl;
                settings.WorkingHours = req.WorkingHours;
                settings.FacebookUrl = req.FacebookUrl;
                settings.TwitterUrl = req.TwitterUrl;
                settings.LinkedinUrl = req.LinkedinUrl;
                settings.CopyrightText = req.CopyrightText;
                
                settings.PreFooterViewAllText = req.PreFooterViewAllText;
                settings.PreFooterViewAllUrl = req.PreFooterViewAllUrl;
                settings.PreFooterViewAllActive = req.PreFooterViewAllActive;
                
                settings.VirtualTourText = req.VirtualTourText;
                settings.VirtualTourUrl = req.VirtualTourUrl;
                settings.VirtualTourActive = req.VirtualTourActive;
                
                settings.IsSearchEnabled = req.IsSearchEnabled;

                settings.UpdatedBy = userName;
                settings.UpdatedAt = DateTime.UtcNow;

                await _context.SaveChangesAsync();
                return Ok(settings);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { error = "Failed to update settings", details = ex.Message });
            }
        }
    }
}
