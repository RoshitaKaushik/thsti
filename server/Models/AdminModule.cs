using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class AdminModule
{
    public int Id { get; set; }

    public string Name { get; set; } = null!;

    public string Path { get; set; } = null!;

    public string IconName { get; set; } = null!;

    public int Order { get; set; }

    public int? ParentId { get; set; }

    public string AllowedRoles { get; set; } = "ADMIN";

    public bool IsActive { get; set; } = true;

    public virtual AdminModule? Parent { get; set; }
    public virtual ICollection<AdminModule> InverseParent { get; set; } = new List<AdminModule>();
}
