using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System;
using System.Threading.Tasks;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/contact-submissions")]
    public class ContactSubmissionsController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public ContactSubmissionsController(ThstiDbContext context)
        {
            _context = context;
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpGet("admin")]
        public async Task<IActionResult> GetAllAdmin()
        {
            var items = await _context.ContactSubmissions
                .OrderByDescending(x => x.CreatedAt)
                .ToListAsync();
            return Ok(items);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut("{id:int}")]
        public async Task<IActionResult> Resolve(int id, [FromBody] ResolveReq req)
        {
            var item = await _context.ContactSubmissions.FindAsync(id);
            if (item == null) return NotFound();

            item.IsResolved = req.IsResolved;

            await _context.SaveChangesAsync();
            return Ok(item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpDelete("{id:int}")]
        public async Task<IActionResult> Delete(int id)
        {
            var item = await _context.ContactSubmissions.FindAsync(id);
            if (item == null) return NotFound();

            _context.ContactSubmissions.Remove(item);
            await _context.SaveChangesAsync();
            return NoContent();
        }

        // Public route for frontend submission
        [HttpPost("public")]
        public async Task<IActionResult> PostPublic([FromBody] ContactSubmission req)
        {
            if (string.IsNullOrWhiteSpace(req.Name) || string.IsNullOrWhiteSpace(req.Email) || string.IsNullOrWhiteSpace(req.Message))
            {
                return BadRequest(new { error = "Name, Email, and Message are required." });
            }

            var item = new ContactSubmission
            {
                Name = req.Name,
                Email = req.Email,
                Phone = req.Phone,
                Message = req.Message,
                IsResolved = false,
                CreatedAt = DateTime.UtcNow
            };

            _context.ContactSubmissions.Add(item);
            await _context.SaveChangesAsync();

            return Ok(new { message = "Submission received successfully." });
        }
    }

    public class ResolveReq
    {
        public bool IsResolved { get; set; }
    }
}
