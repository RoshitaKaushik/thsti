using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class HeroSlide
{
    public long Id { get; set; }

    public string? Title { get; set; }
    public string? TitleHi { get; set; }

    public string? Subtitle { get; set; }
    public string? SubtitleHi { get; set; }

    public string Type { get; set; } = null!;

    public string MediaUrl { get; set; } = null!;

    public string? PosterUrl { get; set; }

    public int DisplayOrder { get; set; }

    public bool IsActive { get; set; }

    public bool IsActiveVideo { get; set; }

    public bool OpenInNewTab { get; set; }

    public string? RouteUrl { get; set; }

    public DateTime CreatedAt { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }

    public string ReviewStatus { get; set; } = "Published"; // Draft, PendingReview, Published, Rejected

    public string? Remarks { get; set; }

    public bool ShowText { get; set; }

    public bool IsArchived { get; set; } = false;
}


