using Microsoft.AspNetCore.Authentication.JwtBearer;
using Microsoft.EntityFrameworkCore;
using Microsoft.IdentityModel.Tokens;
using System.Text;
using ThstiServer.Models;
using System;
using ThstiServer.Interceptors;


var builder = WebApplication.CreateBuilder(args);
builder.WebHost.ConfigureKestrel(options =>
{
    options.Limits.MaxRequestBodySize = 524288000; // 500 MB
});
builder.Services.Configure<IISServerOptions>(options => 
{
    options.MaxRequestBodySize = 524288000; // 500 MB
});

var jwtSecret = builder.Configuration["JWT_SECRET"] ?? "supersecret_thsticms_key_at_least_32_chars_long!!";
var connString = builder.Configuration.GetConnectionString("DefaultConnection") ?? "Server=localhost\\SQLEXPRESS;Database=thsti_dev;Integrated Security=True;TrustServerCertificate=True;";

builder.Services.AddSingleton<AuditInterceptor>();
builder.Services.AddSingleton<ThstiServer.Interceptors.RevisionInterceptor>();

builder.Services.AddDbContext<ThstiDbContext>((sp, options) => {
    var auditInterceptor = sp.GetRequiredService<AuditInterceptor>();
    var revisionInterceptor = sp.GetRequiredService<ThstiServer.Interceptors.RevisionInterceptor>();
    options.UseSqlServer(connString).AddInterceptors(auditInterceptor, revisionInterceptor);
});

builder.Services.AddScoped<ThstiServer.Utils.Mailer>();
builder.Services.AddHostedService<ThstiServer.Services.ArchivalHostedService>();

builder.Services.AddControllers().AddJsonOptions(options =>
{
    options.JsonSerializerOptions.ReferenceHandler = System.Text.Json.Serialization.ReferenceHandler.IgnoreCycles;
});
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

// Configure maximum global form limitations
builder.Services.Configure<Microsoft.AspNetCore.Http.Features.FormOptions>(options =>
{
    options.MultipartBodyLengthLimit = 524288000; // 500 MB
    options.ValueLengthLimit = 524288000;
    options.MultipartHeadersLengthLimit = 32768; // 32 KB
});

// Configure CORS
builder.Services.AddCors(options =>
{
    options.AddPolicy("AllowFrontend", policy =>
    {
        policy.WithOrigins("http://localhost:5173", "http://localhost:5174", "http://localhost:5175")
              .AllowAnyHeader()
              .AllowAnyMethod()
              .AllowCredentials();
    });
});

// Configure JWT Authentication
builder.Services.AddAuthentication(options =>
{
    options.DefaultAuthenticateScheme = JwtBearerDefaults.AuthenticationScheme;
    options.DefaultChallengeScheme = JwtBearerDefaults.AuthenticationScheme;
})
.AddJwtBearer(options =>
{
    options.TokenValidationParameters = new TokenValidationParameters
    {
        ValidateIssuerSigningKey = true,
        IssuerSigningKey = new SymmetricSecurityKey(Encoding.ASCII.GetBytes(jwtSecret)),
        ValidateIssuer = false, // Not using Issuer/Audience validation for this prototyping
        ValidateAudience = false,
        ValidateLifetime = true,
        ClockSkew = TimeSpan.Zero
    };
});

builder.Services.AddHttpContextAccessor();
builder.Services.AddHttpClient();
builder.Services.AddScoped<ThstiServer.Services.ICloudStorageService, ThstiServer.Services.MockNicCloudStorageService>();
builder.Services.AddScoped<ThstiServer.Services.ITranslationService, ThstiServer.Services.GoogleTranslationFallbackService>();
builder.Services.AddScoped<ThstiServer.Services.IBhashiniTranslationService, ThstiServer.Services.BhashiniTranslationService>();

var app = builder.Build();

if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseCors("AllowFrontend");

// GIGW Security Headers
app.Use(async (context, next) =>
{
    context.Response.Headers.Append("X-Frame-Options", "DENY");
    context.Response.Headers.Append("X-Content-Type-Options", "nosniff");
    context.Response.Headers.Append("X-XSS-Protection", "1; mode=block");
    context.Response.Headers.Append("Strict-Transport-Security", "max-age=31536000; includeSubDomains");
    // Flexible CSP for CMS while still being secure
    context.Response.Headers.Append("Content-Security-Policy", "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https: http: blob:; connect-src 'self' http://localhost:5000 http://localhost:5001 ws://localhost:* https://demo.1akal.in;");
    context.Response.Headers.Append("Referrer-Policy", "strict-origin-when-cross-origin");
    await next();
});

app.UseMiddleware<ThstiServer.Middleware.IpWhitelistMiddleware>();
app.UseMiddleware<ThstiServer.Middleware.EncryptionMiddleware>();

app.UseAuthentication();
app.UseAuthorization();

var uploadDir = Path.GetFullPath(Path.Combine(builder.Environment.ContentRootPath, "..", "uploads"));
if (!Directory.Exists(uploadDir)) Directory.CreateDirectory(uploadDir);

// Retain uploads endpoint merely for backwards compatibility of already seeded artifacts
app.UseStaticFiles(new StaticFileOptions
{
    FileProvider = new Microsoft.Extensions.FileProviders.PhysicalFileProvider(uploadDir),
    RequestPath = "/uploads",
    OnPrepareResponse = ctx =>
    {
        ctx.Context.Response.Headers.Append("Cross-Origin-Resource-Policy", "cross-origin");
    }
});

// Configure Mock NIC Cloud Vault Virtual Drive mapping
var mockCloudDir = Path.GetFullPath(Path.Combine(builder.Environment.ContentRootPath, "..", "mock_cloud_storage"));
if (!Directory.Exists(mockCloudDir)) Directory.CreateDirectory(mockCloudDir);

app.UseStaticFiles(new StaticFileOptions
{
    FileProvider = new Microsoft.Extensions.FileProviders.PhysicalFileProvider(mockCloudDir),
    RequestPath = "/cloud-vault",
    OnPrepareResponse = ctx =>
    {
        ctx.Context.Response.Headers.Append("Cross-Origin-Resource-Policy", "cross-origin");
    }
});

app.MapControllers();

using (var scope = app.Services.CreateScope())
{
    var context = scope.ServiceProvider.GetRequiredService<ThstiDbContext>();
    ThstiServer.Services.DbSeeder.Seed(context);
}

app.Run();
