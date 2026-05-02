using System.ComponentModel.DataAnnotations;

namespace ThstiServer.DTOs
{
    public class ResearchCenterRequest
    {
        [Required]
        [MinLength(2)]
        public string Title { get; set; } = null!;

        [Required]
        [MinLength(2)]
        public string Slug { get; set; } = null!;

        [MaxLength(2000)]
        public string? Excerpt { get; set; }

        public string? Content { get; set; }
        public string? OverviewContent { get; set; }
        public string? CareersContent { get; set; }
        public string? AdmissionsContent { get; set; }
        public string? ImageUrl { get; set; }
        public string? RouteUrl { get; set; }
        public bool IsExternal { get; set; }
        public bool OpenInNewTab { get; set; }
        public int DisplayOrder { get; set; }
        public bool IsActive { get; set; } = true;
    }
}
