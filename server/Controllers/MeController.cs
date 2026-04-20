using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System.Security.Claims;
using System.Threading.Tasks;
using System;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/me")]
    [Authorize]
    public class MeController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public MeController(ThstiDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> GetMe()
        {
            var userIdStr = User.FindFirst("userId")?.Value ?? User.FindFirst(ClaimTypes.NameIdentifier)?.Value;
            if (string.IsNullOrEmpty(userIdStr) || !int.TryParse(userIdStr, out int userId))
            {
                var claims = User.Claims.Select(c => new { c.Type, c.Value }).ToList();
                return BadRequest(new { error = "Could not find valid user ID claim", claims });
            }

            var user = await _context.Users.FindAsync(userId);
            if (user == null) return NotFound();

            return Ok(new
            {
                user.Id,
                user.Email,
                user.Name,
                user.Role,
                user.IsActive,
                user.Mobile,
                user.CreatedAt
            });
        }

        [HttpPut("profile")]
        public async Task<IActionResult> UpdateProfile([FromBody] UpdateProfileRequest req)
        {
            var userIdStr = User.FindFirst("userId")?.Value ?? User.FindFirst(ClaimTypes.NameIdentifier)?.Value;
            if (string.IsNullOrEmpty(userIdStr) || !int.TryParse(userIdStr, out int userId))
            {
                var claims = User.Claims.Select(c => new { c.Type, c.Value }).ToList();
                return BadRequest(new { error = "Could not find valid user ID claim", claims });
            }

            var user = await _context.Users.FindAsync(userId);
            if (user == null) return NotFound();

            user.Name = req.Name ?? user.Name;
            user.Mobile = req.Mobile ?? user.Mobile;
            user.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();

            return Ok(new
            {
                user.Id,
                user.Email,
                user.Name,
                user.Role,
                user.IsActive,
                user.Mobile,
                user.CreatedAt
            });
        }
    }

    public class UpdateProfileRequest
    {
        public string? Name { get; set; }
        public string? Mobile { get; set; }
    }
}
