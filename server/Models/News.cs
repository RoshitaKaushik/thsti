using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class News
{
    public long Id { get; set; }

    public string Title { get; set; } = null!;

    public string? TitleHi { get; set; }

    public string Slug { get; set; } = null!;

    public string? Summary { get; set; }

    public string Content { get; set; } = null!;

    public string? ContentHi { get; set; }

    public string? ImageUrl { get; set; }

    public DateTime PublishDate { get; set; }

    public bool IsActive { get; set; }

    public DateTime CreatedAt { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }

    public bool IsFeatured { get; set; }

    public string ReviewStatus { get; set; } = "Published";

    public string? Remarks { get; set; }

    public bool IsArchived { get; set; } = false;
}


