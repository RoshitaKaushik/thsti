using Microsoft.EntityFrameworkCore;
using ThstiServer.Models;
using System;
using System.Linq;

namespace ThstiServer.Services
{
    public static class DbSeeder
    {
        public static void Seed(ThstiDbContext context)
        {
            context.Database.Migrate();

            // 1. Seed Global Settings
            if (!context.GlobalSettings.Any())
            {
                context.GlobalSettings.Add(new GlobalSetting
                {
                    SiteName = "THSTI",
                    VirtualTourActive = true,
                    VirtualTourUrl = "https://demo.1akal.in/thsti/design9/",
                    UpdatedAt = DateTime.UtcNow
                });
            }

            // 2. Seed Languages
            if (!context.TranslationLanguages.Any())
            {
                context.TranslationLanguages.AddRange(
                    new TranslationLanguage { Code = "en", Label = "English", Order = 1, IsActive = true },
                    new TranslationLanguage { Code = "hi", Label = "Hindi (हिंदी)", Order = 2, IsActive = true }
                );
            }

            // 3. Seed Menus
            if (!context.Menus.Any())
            {
                context.Menus.AddRange(
                    new Menu { Label = "About THSTI", Route = "#", Location = "HEADER", Order = 1, IsActive = true },
                    new Menu { Label = "Academics", Route = "#", Location = "HEADER", Order = 2, IsActive = true },
                    new Menu { Label = "Research", Route = "#", Location = "HEADER", Order = 3, IsActive = true, IsMegaMenu = true },
                    new Menu { Label = "Facilities", Route = "#", Location = "HEADER", Order = 4, IsActive = true }
                );
            }

            // 4. Seed Hero Slides
            if (!context.HeroSlides.Any())
            {
                context.HeroSlides.AddRange(
                    new HeroSlide { Title = "16th Foundation Day Celebrations", Subtitle = "Translational Health Science and Technology Institute", MediaUrl = "https://thsti.res.in/public/slider/1752813878banner.png", Type = "IMAGE", DisplayOrder = 1, IsActive = true },
                    new HeroSlide { Title = "General Slider", Subtitle = "Heart of India's Biotech Revolution", MediaUrl = "https://thsti.res.in/public/slider/1766032829banner.jpg", Type = "IMAGE", DisplayOrder = 2, IsActive = true },
                    new HeroSlide { Title = "IISF-2025 Curtain Raiser", Subtitle = "Science for society", MediaUrl = "https://thsti.res.in/public/slider/1765947193banner.jpg", Type = "IMAGE", DisplayOrder = 3, IsActive = true }
                );
            }

            // 5. Seed Users
            if (!context.Users.Any())
            {
                var hardPassword = BCrypt.Net.BCrypt.HashPassword("Admin@123");
                context.Users.Add(new User
                {
                    Email = "admin@thsti.res.in",
                    Password = hardPassword,
                    Name = "System Administrator",
                    Username = "admin",
                    Role = "ADMIN",
                    IsActive = true,
                    CreatedAt = DateTime.UtcNow,
                    UpdatedAt = DateTime.UtcNow
                });
                
                var execPassword = BCrypt.Net.BCrypt.HashPassword("Exec@123");
                context.Users.Add(new User
                {
                    Email = "executive@thsti.res.in",
                    Password = execPassword,
                    Name = "Junior Executive",
                    Username = "exec",
                    Role = "EXECUTIVE",
                    IsActive = true,
                    CreatedAt = DateTime.UtcNow,
                    UpdatedAt = DateTime.UtcNow
                });
                context.SaveChanges();
            }

            // 6. Seed Admin Modules (Sidebar)
            if (!context.AdminModules.Any())
            {
                var modules = new List<AdminModule>
                {
                    new AdminModule { Name = "Dashboard", Path = "/dashboard", IconName = "LayoutDashboard", Order = 1 },
                    new AdminModule { Name = "Menu Config", Path = "/dashboard/menus", IconName = "MenuIcon", Order = 2 },
                    new AdminModule { Name = "Home Page", Path = "#", IconName = "Home", Order = 3 },
                    new AdminModule { Name = "Pages", Path = "/dashboard/pages", IconName = "FileText", Order = 4 },
                    new AdminModule { Name = "Faculty", Path = "/dashboard/faculty", IconName = "GraduationCap", Order = 5 },
                    new AdminModule { Name = "News & Events", Path = "/dashboard/news", IconName = "Newspaper", Order = 6 },
                    new AdminModule { Name = "Int'l Collaboration", Path = "/dashboard/international-collaboration", IconName = "Globe", Order = 7 },
                    new AdminModule { Name = "Tenders", Path = "/dashboard/tenders", IconName = "FileText", Order = 8 },
                    new AdminModule { Name = "Feedback Submissions", Path = "/dashboard/contact-submissions", IconName = "FileText", Order = 9 },
                    new AdminModule { Name = "Media Library", Path = "/dashboard/media", IconName = "Image", Order = 10 },
                    new AdminModule { Name = "Languages", Path = "/dashboard/languages", IconName = "Languages", Order = 11 },
                    new AdminModule { Name = "Pre-Footer Strip", Path = "/dashboard/pre-footer-links", IconName = "LayoutTemplate", Order = 12 },
                    new AdminModule { Name = "Footer Links", Path = "/dashboard/footer-links", IconName = "LayoutTemplate", Order = 13 },
                    new AdminModule { Name = "What's New (Marquee)", Path = "/dashboard/marquee", IconName = "Megaphone", Order = 14 },
                    new AdminModule { Name = "Notifications", Path = "/dashboard/notifications", IconName = "Bell", Order = 15 },
                    new AdminModule { Name = "Users", Path = "/dashboard/users", IconName = "Users", Order = 16 },
                    new AdminModule { Name = "Settings", Path = "/dashboard/settings", IconName = "Settings", Order = 17 },
                };
                context.AdminModules.AddRange(modules);
                context.SaveChanges();

                var homeModule = context.AdminModules.FirstOrDefault(m => m.Name == "Home Page");
                if (homeModule != null)
                {
                    context.AdminModules.AddRange(
                        new AdminModule { Name = "Hero Slider", Path = "/dashboard/hero-slides", IconName = "Image", Order = 1, ParentId = homeModule.Id },
                        new AdminModule { Name = "Home Sections", Path = "/dashboard/sections", IconName = "LayoutTemplate", Order = 2, ParentId = homeModule.Id },
                        new AdminModule { Name = "Research Centers", Path = "/dashboard/research-centers", IconName = "Beaker", Order = 3, ParentId = homeModule.Id },
                        new AdminModule { Name = "Research Facilities", Path = "/dashboard/research-facilities", IconName = "Beaker", Order = 4, ParentId = homeModule.Id },
                        new AdminModule { Name = "Programmes", Path = "/dashboard/programmes", IconName = "FileText", Order = 5, ParentId = homeModule.Id },
                        new AdminModule { Name = "Life on The THSTI", Path = "/dashboard/life-at-thsti", IconName = "LayoutTemplate", Order = 6, ParentId = homeModule.Id }
                    );
                    context.SaveChanges();
                }
            }

            // 7. Update Legacy Page Types
            var legacyPages = context.Pages.Where(p => p.PageType == "Standard" || p.PageType == "DynamicListing").ToList();
            foreach(var p in legacyPages) {
                if (p.PageType == "Standard") p.PageType = "Template";
                if (p.PageType == "DynamicListing") p.PageType = "ModuleLinked";
            }
            if (legacyPages.Any()) context.SaveChanges();

            // 8. Seed ModuleLinked Pages for Core Modules
            var coreModules = new[] {
                new { Title = "Faculty and Scientists", Slug = "faculty-and-scientists" },
                new { Title = "Tenders", Slug = "tenders" },
                new { Title = "News and Events", Slug = "news-and-events" },
                new { Title = "Notifications", Slug = "notifications" },
                new { Title = "Research Centers", Slug = "research-centers" },
                new { Title = "Research Facilities", Slug = "research-facilities" },
                new { Title = "Programmes", Slug = "programmes" },
                new { Title = "International Collaboration", Slug = "international-collaboration" },
                new { Title = "Life at THSTI", Slug = "life-at-thsti" }
            };

            bool pagesAdded = false;
            foreach (var mod in coreModules)
            {
                if (!context.Pages.Any(p => p.Slug == mod.Slug))
                {
                    context.Pages.Add(new Page
                    {
                        Title = mod.Title,
                        Slug = mod.Slug,
                        Content = "",
                        IsActive = true,
                        PageType = "ModuleLinked",
                        CreatedAt = DateTime.UtcNow,
                        UpdatedAt = DateTime.UtcNow
                    });
                    pagesAdded = true;
                }
            }
            if (pagesAdded) context.SaveChanges();

            // 9. Seed Standard Policy Pages
            var policyPages = new[] {
                new { Title = "Privacy Policy", Slug = "privacy-policy" },
                new { Title = "Copyright Policy", Slug = "copyright-policy" },
                new { Title = "Terms of Use", Slug = "terms-of-use" },
                new { Title = "Hyperlinking Policy", Slug = "hyperlinking-policy" },
                new { Title = "Website Policies", Slug = "website-policies" }
            };

            bool policiesAdded = false;
            foreach (var pol in policyPages)
            {
                if (!context.Pages.Any(p => p.Slug == pol.Slug))
                {
                    context.Pages.Add(new Page
                    {
                        Title = pol.Title,
                        Slug = pol.Slug,
                        Content = $"<h2>{pol.Title}</h2><p>Content for {pol.Title} goes here. Please edit in CMS.</p>",
                        IsActive = true,
                        PageType = "Template",
                        TemplateConfigJson = "{}",
                        CreatedAt = DateTime.UtcNow,
                        UpdatedAt = DateTime.UtcNow
                    });
                    policiesAdded = true;
                }
            }
            if (policiesAdded) context.SaveChanges();
        }
    }
}
