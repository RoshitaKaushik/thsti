using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class FooterLink
{
    public long Id { get; set; }

    public string Column { get; set; } = null!;

    public string Label { get; set; } = null!;

    public string Url { get; set; } = null!;

    public int DisplayOrder { get; set; }

    public bool IsActive { get; set; }

    public DateTime CreatedAt { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }
}


