using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class TranslationLanguage
{
    public long Id { get; set; }

    public string Code { get; set; } = null!;

    public string Label { get; set; } = null!;

    public int Order { get; set; }

    public bool IsActive { get; set; }

    public DateTime CreatedAt { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }
}


