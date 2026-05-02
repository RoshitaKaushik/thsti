using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Diagnostics;
using System.Text.Json;
using System.Threading;
using System.Threading.Tasks;
using ThstiServer.Models;
using System.Linq;
using System;
using System.Collections.Generic;

namespace ThstiServer.Interceptors
{
    public class RevisionInterceptor : SaveChangesInterceptor
    {
        private readonly string[] _monitoredEntities = new[]
        {
            "ResearchCenter",
            "ResearchFacility",
            "Page",
            "News",
            "Faculty"
        };

        public override InterceptionResult<int> SavingChanges(DbContextEventData eventData, InterceptionResult<int> result)
        {
            ProcessRevisions(eventData.Context);
            return base.SavingChanges(eventData, result);
        }

        public override ValueTask<InterceptionResult<int>> SavingChangesAsync(DbContextEventData eventData, InterceptionResult<int> result, CancellationToken cancellationToken = default)
        {
            ProcessRevisions(eventData.Context);
            return base.SavingChangesAsync(eventData, result, cancellationToken);
        }

        private void ProcessRevisions(DbContext context)
        {
            if (context == null) return;

            var entries = context.ChangeTracker.Entries()
                .Where(e => e.State == EntityState.Modified)
                .ToList();

            foreach (var entry in entries)
            {
                var entityType = entry.Entity.GetType().Name;

                // Handle Castle proxy names if lazy loading is enabled
                if (entityType.Contains("Proxy"))
                {
                    entityType = entry.Entity.GetType().BaseType?.Name ?? entityType;
                }

                if (_monitoredEntities.Contains(entityType))
                {
                    // Create a dictionary of original values
                    var originalValuesDict = new Dictionary<string, object>();
                    foreach (var property in entry.OriginalValues.Properties)
                    {
                        originalValuesDict[property.Name] = entry.OriginalValues[property];
                    }

                    // For ID, assume there's a property named "Id" (all our monitored entities use int or long Id)
                    var idProp = entry.Property("Id");
                    long entityId = 0;
                    if (idProp != null && idProp.CurrentValue != null)
                    {
                        entityId = Convert.ToInt64(idProp.CurrentValue);
                    }

                    // Try to get "UpdatedBy" if it exists
                    string changedBy = "System";
                    var updatedByProp = entry.Properties.FirstOrDefault(p => p.Metadata.Name == "UpdatedBy");
                    if (updatedByProp != null && updatedByProp.CurrentValue != null)
                    {
                        changedBy = updatedByProp.CurrentValue.ToString();
                    }

                    var snapshotJson = JsonSerializer.Serialize(originalValuesDict);

                    var revision = new CmsRevision
                    {
                        EntityType = entityType,
                        EntityId = entityId,
                        SnapshotJson = snapshotJson,
                        ChangedBy = changedBy,
                        CreatedAt = DateTime.UtcNow
                    };

                    context.Add(revision);
                }
            }
        }
    }
}
