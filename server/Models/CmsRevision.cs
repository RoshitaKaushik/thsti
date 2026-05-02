using System;

namespace ThstiServer.Models
{
    public class CmsRevision
    {
        public long Id { get; set; }
        public string EntityType { get; set; } // e.g., "ResearchCenter", "Page"
        public long EntityId { get; set; }
        public string SnapshotJson { get; set; } // JSON representation of the entity before modification
        public string ChangedBy { get; set; } // User who made the change
        public DateTime CreatedAt { get; set; }
    }
}
