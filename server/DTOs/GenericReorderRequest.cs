using System.Collections.Generic;

namespace ThstiServer.DTOs
{
    public class GenericReorderItem
    {
        public long Id { get; set; }
        public int DisplayOrder { get; set; }
    }

    public class GenericReorderRequest
    {
        public List<GenericReorderItem> Orders { get; set; } = new();
    }
}

