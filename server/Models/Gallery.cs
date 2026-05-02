using System;
using System.Collections.Generic;

namespace ThstiServer.Models;

public partial class Gallery
{
    public long Id { get; set; }

    public string? Title { get; set; }

    public string ImageUrl { get; set; } = null!;

    public long? CategoryId { get; set; }

    public DateTime CreatedAt { get; set; }

    public virtual GalleryCategory? Category { get; set; }
}

