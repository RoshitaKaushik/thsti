using System;

namespace ThstiServer.Models;

public partial class Tender
{
    public long Id { get; set; }

    public string Title { get; set; } = null!;
    public string? TitleHi { get; set; }

    public string ReferenceNo { get; set; } = null!;

    public DateTime PublishDate { get; set; }
    public DateTime ClosingDate { get; set; }

    public string DocumentUrl { get; set; } = null!;

    public bool IsArchived { get; set; }
    
    public string ReviewStatus { get; set; } = "Draft";
    public string? Remarks { get; set; }

    public DateTime CreatedAt { get; set; }
    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }
}


