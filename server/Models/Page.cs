using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class Page
{
    public long Id { get; set; }

    public string Title { get; set; } = null!;

    public string Slug { get; set; } = null!;

    public string Content { get; set; } = null!;

    public string? MetaTitle { get; set; }

    public string? MetaDescription { get; set; }

    public string? OgImage { get; set; }

    public bool IsActive { get; set; }

    public string PageType { get; set; } = "Standard";

    public string? BannerImageUrl { get; set; }

    public string? BreadcrumbTitle { get; set; }

    public string? TemplateConfigJson { get; set; }

    public DateTime CreatedAt { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }
}
