using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using Microsoft.Extensions.Hosting;
using Microsoft.Extensions.Logging;
using System;
using System.Threading;
using System.Threading.Tasks;
using ThstiServer.Models;

namespace ThstiServer.Services
{
    public class ArchivalHostedService : BackgroundService
    {
        private readonly ILogger<ArchivalHostedService> _logger;
        private readonly IServiceProvider _serviceProvider;

        public ArchivalHostedService(ILogger<ArchivalHostedService> logger, IServiceProvider serviceProvider)
        {
            _logger = logger;
            _serviceProvider = serviceProvider;
        }

        protected override async Task ExecuteAsync(CancellationToken stoppingToken)
        {
            _logger.LogInformation("Archival Hosted Service starting.");

            while (!stoppingToken.IsCancellationRequested)
            {
                try
                {
                    await ArchiveExpiredContentAsync();
                }
                catch (Exception ex)
                {
                    _logger.LogError(ex, "Error occurred executing Archival task.");
                }

                // Wait 24 hours before running again, or compute time until midnight 00:01 AM
                var now = DateTime.Now;
                var nextRun = now.Date.AddDays(1).AddMinutes(1);
                var delay = nextRun - now;
                
                await Task.Delay(delay, stoppingToken);
            }

            _logger.LogInformation("Archival Hosted Service is stopping.");
        }

        private async Task ArchiveExpiredContentAsync()
        {
            using (var scope = _serviceProvider.CreateScope())
            {
                var context = scope.ServiceProvider.GetRequiredService<ThstiDbContext>();

                // In the current schema, if there's an ExpiryDate on Tenders or News (or publish date logic), we archive them.
                // Assuming News has a concept of expiry or archive logic. Let's assume News with a past IsActive date etc.
                // NOTE: Based on the prompt's `tbl_tenders` and `tbl_events`, we assume the entity has IsActive/IsArchived.
                // Since the provided DbContext might not specifically have IsArchived out of the box in the `News` table right now, 
                // we will toggle IsActive = false where PublishDate is older than 1 year as a placeholder archival logic 
                // until ExpiryDate is strictly added to the schema.
                
                var oldNews = await context.News
                    .Where(n => n.IsActive == true && n.PublishDate < DateTime.UtcNow.AddYears(-1))
                    .ToListAsync();

                foreach (var news in oldNews)
                {
                    news.IsActive = false; // "Archiving" mechanism by default visibility reduction
                    _logger.LogInformation("Archived News: {NewsTitle}", news.Title);
                }

                // Phase 4: Enforce Tenders auto-archiving logic based on ClosingDate
                var expiredTenders = await context.Tenders
                    .Where(t => t.IsArchived == false && t.ClosingDate < DateTime.UtcNow)
                    .ToListAsync();

                foreach (var tender in expiredTenders)
                {
                    tender.IsArchived = true;
                    _logger.LogInformation("Auto-Archived Tender: {TenderRef}", tender.ReferenceNo);
                }

                if (oldNews.Count > 0 || expiredTenders.Count > 0)
                {
                    await context.SaveChangesAsync();
                }
            }
        }
    }
}
