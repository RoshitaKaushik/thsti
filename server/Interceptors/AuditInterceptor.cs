using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Diagnostics;
using System;
using System.Linq;
using System.Security.Claims;
using System.Threading;
using System.Threading.Tasks;

namespace ThstiServer.Interceptors
{
    public class AuditInterceptor : SaveChangesInterceptor
    {
        private readonly IHttpContextAccessor _httpContextAccessor;

        public AuditInterceptor(IHttpContextAccessor httpContextAccessor)
        {
            _httpContextAccessor = httpContextAccessor;
        }

        public override InterceptionResult<int> SavingChanges(DbContextEventData eventData, InterceptionResult<int> result)
        {
            UpdateAuditFields(eventData.Context);
            return base.SavingChanges(eventData, result);
        }

        public override ValueTask<InterceptionResult<int>> SavingChangesAsync(DbContextEventData eventData, InterceptionResult<int> result, CancellationToken cancellationToken = default)
        {
            UpdateAuditFields(eventData.Context);
            return base.SavingChangesAsync(eventData, result, cancellationToken);
        }

        private void UpdateAuditFields(DbContext? context)
        {
            if (context == null) return;

            // Extract the User ID. 
            // Fallback to "System" if the context is null (e.g. running in a background job or seeder)
            var currentUserId = _httpContextAccessor.HttpContext?.User?.FindFirst(ClaimTypes.NameIdentifier)?.Value ?? "System";

            var entries = context.ChangeTracker.Entries().Where(e => e.State == EntityState.Added || e.State == EntityState.Modified);

            foreach (var entry in entries)
            {
                if (entry.State == EntityState.Added)
                {
                    // Update CreatedAt
                    var createdAtProp = entry.Properties.FirstOrDefault(p => p.Metadata.Name == "CreatedAt");
                    if (createdAtProp != null && createdAtProp.CurrentValue is DateTime date && date == default)
                    {
                        createdAtProp.CurrentValue = DateTime.UtcNow;
                    }
                    else if (createdAtProp != null && createdAtProp.CurrentValue == null)
                    {
                        createdAtProp.CurrentValue = DateTime.UtcNow;
                    }

                    // Update CreatedBy
                    var createdByProp = entry.Properties.FirstOrDefault(p => p.Metadata.Name == "CreatedBy");
                    if (createdByProp != null && string.IsNullOrEmpty(createdByProp.CurrentValue as string))
                    {
                        createdByProp.CurrentValue = currentUserId;
                    }
                }
                
                if (entry.State == EntityState.Modified)
                {
                    // Ensure the entity actually has changed values (ignores unchanged updates)
                    if (entry.Properties.Any(p => p.IsModified))
                    {
                        // Update UpdatedAt
                        var updatedAtProp = entry.Properties.FirstOrDefault(p => p.Metadata.Name == "UpdatedAt");
                        if (updatedAtProp != null)
                        {
                            updatedAtProp.CurrentValue = DateTime.UtcNow;
                        }

                        // Update UpdatedBy
                        var updatedByProp = entry.Properties.FirstOrDefault(p => p.Metadata.Name == "UpdatedBy");
                        if (updatedByProp != null)
                        {
                            updatedByProp.CurrentValue = currentUserId;
                        }
                    }
                }
            }
        }
    }
}
