using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class GlobalSetting
{
    public long Id { get; set; }

    public string SiteName { get; set; } = null!;

    public string? LogoUrl { get; set; }

    public string? ContactEmail { get; set; }

    public string? ContactPhone { get; set; }

    public string? Address { get; set; }

    public string? MapLink { get; set; }
    public string? FooterImageUrl { get; set; }

    public string? FacebookUrl { get; set; }

    public string? TwitterUrl { get; set; }

    public string? LinkedinUrl { get; set; }

    public string? CopyrightText { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }

    public DateTime CreatedAt { get; set; }

    public bool PreFooterViewAllActive { get; set; }

    public string? PreFooterViewAllText { get; set; }

    public string? PreFooterViewAllUrl { get; set; }

    public string? WorkingHours { get; set; }

    public bool IsSearchEnabled { get; set; }

    public bool VirtualTourActive { get; set; }

    public string? VirtualTourText { get; set; }

    public string? VirtualTourUrl { get; set; }
}


