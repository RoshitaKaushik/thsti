using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using System.Linq;
using System;
using System.Threading.Tasks;
using System.Text.Json;
using System.Collections.Generic;

namespace ThstiServer.Controllers
{
    [ApiController]
    [Route("api/revisions")]
    public class RevisionsController : ControllerBase
    {
        private readonly ThstiDbContext _context;

        public RevisionsController(ThstiDbContext context)
        {
            _context = context;
        }

        [HttpGet("{entityType}/{entityId}")]
        public async Task<IActionResult> GetRevisions(string entityType, long entityId)
        {
            var revisions = await _context.CmsRevisions
                .Where(r => r.EntityType == entityType && r.EntityId == entityId)
                .OrderByDescending(r => r.CreatedAt)
                .ToListAsync();

            return Ok(revisions);
        }

        [HttpPost("{revisionId}/revert")]
        public async Task<IActionResult> RevertRevision(long revisionId)
        {
            var revision = await _context.CmsRevisions.FindAsync(revisionId);
            if (revision == null) return NotFound(new { error = "Revision not found" });

            // Depending on EntityType, find the entity and apply properties
            object entity = null;
            if (revision.EntityType == "ResearchCenter") entity = await _context.ResearchCenters.FindAsync(revision.EntityId);
            else if (revision.EntityType == "ResearchFacility") entity = await _context.ResearchFacilities.FindAsync(revision.EntityId);
            else if (revision.EntityType == "Page") entity = await _context.Pages.FindAsync(revision.EntityId);
            else if (revision.EntityType == "News") entity = await _context.News.FindAsync(revision.EntityId);
            else if (revision.EntityType == "Faculty") entity = await _context.Faculties.FindAsync(revision.EntityId);
            
            if (entity == null) return NotFound(new { error = "Target entity not found" });

            try
            {
                var snapshot = JsonSerializer.Deserialize<Dictionary<string, object>>(revision.SnapshotJson);
                if (snapshot != null)
                {
                    var entry = _context.Entry(entity);
                    foreach (var prop in entry.Properties)
                    {
                        if (prop.Metadata.Name != "Id" && snapshot.ContainsKey(prop.Metadata.Name))
                        {
                            var dictValue = snapshot[prop.Metadata.Name];
                            
                            // If the JSON explicitly had null, set property to null and continue
                            if (dictValue == null)
                            {
                                prop.CurrentValue = null;
                                continue;
                            }

                            var jsonElement = (JsonElement)dictValue;
                            object value = null;
                            
                            // Convert JsonElement to the correct type
                            if (jsonElement.ValueKind != JsonValueKind.Null)
                            {
                                var targetType = prop.Metadata.ClrType;
                                if (Nullable.GetUnderlyingType(targetType) != null)
                                {
                                    targetType = Nullable.GetUnderlyingType(targetType);
                                }

                                if (targetType == typeof(string)) value = jsonElement.GetString();
                                else if (targetType == typeof(int)) value = jsonElement.GetInt32();
                                else if (targetType == typeof(long)) value = jsonElement.GetInt64();
                                else if (targetType == typeof(bool)) value = jsonElement.GetBoolean();
                                else if (targetType == typeof(DateTime)) value = jsonElement.GetDateTime();
                            }
                            
                            prop.CurrentValue = value;
                        }
                    }

                    // Save the revert (the interceptor will automatically take a new snapshot of the pre-revert state)
                    await _context.SaveChangesAsync();
                }

                return Ok(new { message = "Successfully reverted" });
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { error = "Failed to revert", details = ex.ToString() });
            }
        }
    }
}
