namespace ThstiServer.DTOs
{
    public class HeroSlideRequest
    {
        public string Title { get; set; } = string.Empty;
        public string? TitleHi { get; set; }
        public string? Subtitle { get; set; }
        public string? SubtitleHi { get; set; }
        public string? Type { get; set; }
        public string? MediaUrl { get; set; }
        public string? PosterUrl { get; set; }
        public int DisplayOrder { get; set; }
        public bool IsActive { get; set; }
        public bool IsActiveVideo { get; set; }
        public bool OpenInNewTab { get; set; }
        public string? RouteUrl { get; set; }
        public bool ShowText { get; set; } = true;
        public string? ReviewStatus { get; set; } // Draft, PendingReview, Published, Rejected
        public string? Remarks { get; set; }
        public bool IsArchived { get; set; }
    }

    public class ReorderItem
    {
        public int Id { get; set; }
        public int Order { get; set; }
    }

    public class ReorderRequest
    {
        public List<ReorderItem> Items { get; set; } = new List<ReorderItem>();
    }
}
