using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using Microsoft.AspNetCore.Authorization;
using System.Linq;
using System.Threading.Tasks;
using System.Collections.Generic;
using System;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/admin-sidebar")]
    [Authorize]
    public class AdminSidebarController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public AdminSidebarController(ThstiDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<IActionResult> GetSidebar()
        {
            var roleClaim = User.FindFirst(System.Security.Claims.ClaimTypes.Role)?.Value ?? "VIEWER";
            
            // Fetch all active modules
            var modules = await _context.AdminModules
                .Where(m => m.IsActive)
                .OrderBy(m => m.Order)
                .ToListAsync();
            
            // Filter modules where AllowedRoles contains current role (case-insensitive for safety)
            var allowedModules = modules.Where(m => 
                !string.IsNullOrEmpty(m.AllowedRoles) && 
                m.AllowedRoles.Split(',').Select(r => r.Trim().ToUpper()).Contains(roleClaim.ToUpper())
            ).ToList();

            // Transform into tree structure
            var parentModules = allowedModules.Where(m => m.ParentId == null).Select(p => new
            {
                p.Id,
                name = p.Name,
                path = p.Path,
                icon = p.IconName,
                children = allowedModules.Where(c => c.ParentId == p.Id).Select(c => new
                {
                    c.Id,
                    name = c.Name,
                    path = c.Path,
                    icon = c.IconName
                }).ToList()
            }).ToList();

            // Return flattened children safely wrapped
            return Ok(parentModules);
        }

        [HttpGet("all-modules")]
        [Authorize(Roles = "ADMIN")]
        public async Task<IActionResult> GetAllModules()
        {
            var modules = await _context.AdminModules
                .OrderBy(m => m.ParentId)
                .ThenBy(m => m.Order)
                .Select(m => new {
                    m.Id,
                    m.Name,
                    m.Path,
                    m.IconName,
                    m.AllowedRoles,
                    m.ParentId,
                    m.IsActive,
                    ParentName = m.Parent != null ? m.Parent.Name : null
                })
                .ToListAsync();
                
            return Ok(modules);
        }

        [HttpPut("{id}")]
        [Authorize(Roles = "ADMIN")]
        public async Task<IActionResult> UpdateModuleRoles(long id, [FromBody] UpdateRolesRequest req)
        {
            var module = await _context.AdminModules.FindAsync(id);
            if (module == null) return NotFound();

            module.AllowedRoles = req.AllowedRoles;
            module.IsActive = req.IsActive;
            await _context.SaveChangesAsync();
            return Ok(new { success = true });
        }
    }

    public class UpdateRolesRequest
    {
        public string AllowedRoles { get; set; } = "";
        public bool IsActive { get; set; }
    }
}

