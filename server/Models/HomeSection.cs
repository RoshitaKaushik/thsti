using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class HomeSection
{
    public long Id { get; set; }

    public string SectionType { get; set; } = null!;

    public string? Title { get; set; }

    public string? Subtitle { get; set; }

    public string? Description { get; set; }

    public string? ImageUrl { get; set; }

    public string? CtaText { get; set; }

    public string? CtaLink { get; set; }

    public bool IsActive { get; set; }

    public string? Metadata { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }
}


