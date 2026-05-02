using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class Menu
{
    public long Id { get; set; }

    public string Label { get; set; } = null!;

    public string? Route { get; set; }

    public int Order { get; set; }

    public bool IsActive { get; set; }

    public long? ParentId { get; set; }

    public DateTime CreatedAt { get; set; }

    public DateTime UpdatedAt { get; set; }

    public string? CreatedBy { get; set; }

    public string? UpdatedBy { get; set; }

    public bool IsExternal { get; set; }

    public bool IsVisible { get; set; }

    public bool TargetBlank { get; set; }

    public string Location { get; set; } = null!;

    public bool IsMegaMenu { get; set; }

    public virtual ICollection<Menu> InverseParent { get; set; } = new List<Menu>();

    public virtual Menu? Parent { get; set; }
}


