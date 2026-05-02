namespace ThstiServer.DTOs
{
    public class PageRequest
    {
        public string Title { get; set; } = string.Empty;
        public string Slug { get; set; } = string.Empty;
        public string Content { get; set; } = string.Empty;
        public string? OgImage { get; set; }
        public string? MetaTitle { get; set; }
        public string? MetaDescription { get; set; }
        public bool IsActive { get; set; } = true;
        public string PageType { get; set; } = "Standard";
        public string? BannerImageUrl { get; set; }
        public string? BreadcrumbTitle { get; set; }
        public string? TemplateConfigJson { get; set; }
    }
}
