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
    [Route("api/life-at-thsti")]
    public class LifeAtThstiItemsController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public LifeAtThstiItemsController(ThstiDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> GetAll()
        {
            var items = await _context.LifeAtThstiItems
                .OrderBy(x => x.DisplayOrder).ToListAsync();
            return Ok(items);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpGet("admin")]
        public async Task<IActionResult> GetAllAdmin()
        {
            var items = await _context.LifeAtThstiItems
                .OrderBy(x => x.DisplayOrder).ToListAsync();
            return Ok(items);
        }

        [HttpGet("{id:long}")]
        public async Task<IActionResult> GetById(long id)
        {
            var item = await _context.LifeAtThstiItems.FindAsync(id);
            if (item == null) return NotFound();
            return Ok(item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPost]
        public async Task<IActionResult> Create([FromBody] LifeAtThstiItem item)
        {
            item.CreatedAt = DateTime.UtcNow;
            item.UpdatedAt = DateTime.UtcNow;
            _context.LifeAtThstiItems.Add(item);
            await _context.SaveChangesAsync();
            return StatusCode(201, item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut("{id:long}")]
        public async Task<IActionResult> Update(long id, [FromBody] LifeAtThstiItem updatedItem)
        {
            var item = await _context.LifeAtThstiItems.FindAsync(id);
            if (item == null) return NotFound();

            _context.Entry(item).CurrentValues.SetValues(updatedItem);
            item.Id = id; 
            item.UpdatedAt = DateTime.UtcNow;

            await _context.SaveChangesAsync();
            return Ok(item);
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpDelete("{id:long}")]
        public async Task<IActionResult> Delete(long id)
        {
            var item = await _context.LifeAtThstiItems.FindAsync(id);
            if (item == null) return NotFound();

            _context.LifeAtThstiItems.Remove(item);
            await _context.SaveChangesAsync();
            return NoContent();
        }

        [Authorize(Roles = "ADMIN,MANAGER,EXECUTIVE")]
        [HttpPut("reorder")]
        public async Task<IActionResult> Reorder([FromBody] ThstiServer.DTOs.GenericReorderRequest req)
        {
            using var transaction = await _context.Database.BeginTransactionAsync();
            try
            {
                foreach (var order in req.Orders)
                {
                    var item = await _context.LifeAtThstiItems.FindAsync(order.Id);
                    if (item != null) item.DisplayOrder = order.DisplayOrder;
                }
                await _context.SaveChangesAsync();
                await transaction.CommitAsync();
                return Ok(new { message = "Reordered successfully" });
            }
            catch(Exception)
            {
                await transaction.RollbackAsync();
                return StatusCode(500, new { error = "Failed to reorder" });
            }
        }

    }
}

