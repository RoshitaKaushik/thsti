using Microsoft.AspNetCore.Http;
using System.IO;
using System.Threading.Tasks;
using System;

namespace ThstiServer.Services
{
    public interface ICloudStorageService
    {
        Task<string> UploadFileAsync(IFormFile file, string bucketName = "thsti-vault");
        Task<bool> DeleteFileAsync(string fileUrl, string bucketName = "thsti-vault");
    }

    /// <summary>
    /// Phase 2 Mock Implementation simulating NIC Cloud/S3 without requiring real credentials.
    /// This safely isolates files in a virtual mock-bucket directory.
    /// </summary>
    public class MockNicCloudStorageService : ICloudStorageService
    {
        private readonly string _mockBucketBasePath;
        private readonly IHttpContextAccessor _httpContextAccessor;

        public MockNicCloudStorageService(IWebHostEnvironment env, IHttpContextAccessor httpContextAccessor)
        {
            // Simulate an external mapped drive / cloud mount
            _mockBucketBasePath = Path.GetFullPath(Path.Combine(env.ContentRootPath, "..", "mock_cloud_storage"));
            if (!Directory.Exists(_mockBucketBasePath))
                Directory.CreateDirectory(_mockBucketBasePath);

            _httpContextAccessor = httpContextAccessor;
        }

        public async Task<string> UploadFileAsync(IFormFile file, string bucketName = "thsti-vault")
        {
            var bucketPath = Path.Combine(_mockBucketBasePath, bucketName);
            if (!Directory.Exists(bucketPath))
                Directory.CreateDirectory(bucketPath);

            var ext = Path.GetExtension(file.FileName);
            var safeFilename = $"{Guid.NewGuid()}{ext}";
            var physicalPath = Path.Combine(bucketPath, safeFilename);

            using (var stream = new FileStream(physicalPath, FileMode.Create))
            {
                await file.CopyToAsync(stream);
            }

            // Generate a Mock URI mimicking standard Cloud Object endpoints (e.g., https://nic-cloud.gov.in/thsti-vault/uuid.pdf)
            // For dev viewing, we'll route it through a specialized download endpoint or serve statically
            var request = _httpContextAccessor.HttpContext?.Request;
            var baseUrl = request != null ? $"{request.Scheme}://{request.Host}" : "http://localhost:5001";
            
            return $"{baseUrl}/cloud-vault/{bucketName}/{safeFilename}";
        }

        public Task<bool> DeleteFileAsync(string fileUrl, string bucketName = "thsti-vault")
        {
            try
            {
                var uri = new Uri(fileUrl);
                var segments = uri.Segments;
                var filename = segments[^1];
                var physicalPath = Path.Combine(_mockBucketBasePath, bucketName, filename);

                if (File.Exists(physicalPath))
                {
                    File.Delete(physicalPath);
                    return Task.FromResult(true);
                }
                return Task.FromResult(false);
            }
            catch
            {
                return Task.FromResult(false);
            }
        }
    }
}
