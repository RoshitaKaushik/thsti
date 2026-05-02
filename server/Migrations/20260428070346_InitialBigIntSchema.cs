using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ThstiServer.Migrations
{
    /// <inheritdoc />
    public partial class InitialBigIntSchema : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "_prisma_migrations",
                columns: table => new
                {
                    id = table.Column<string>(type: "nvarchar(36)", maxLength: 36, nullable: false),
                    checksum = table.Column<string>(type: "nvarchar(64)", maxLength: 64, nullable: false),
                    finished_at = table.Column<DateTime>(type: "datetime2", nullable: true),
                    migration_name = table.Column<string>(type: "nvarchar(255)", maxLength: 255, nullable: false),
                    logs = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    rolled_back_at = table.Column<DateTime>(type: "datetime2", nullable: true),
                    started_at = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "GETDATE()"),
                    applied_steps_count = table.Column<int>(type: "int", nullable: false, defaultValue: 0)
                },
                constraints: table =>
                {
                    table.PrimaryKey("_prisma_migrations_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "AdminModule",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    name = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    path = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    iconName = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    order = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    parentId = table.Column<long>(type: "bigint", nullable: true),
                    allowedRoles = table.Column<string>(type: "nvarchar(max)", nullable: false, defaultValue: "ADMIN"),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_AdminModule", x => x.id);
                    table.ForeignKey(
                        name: "FK_AdminModule_AdminModule_parentId",
                        column: x => x.parentId,
                        principalTable: "AdminModule",
                        principalColumn: "id");
                });

            migrationBuilder.CreateTable(
                name: "ContactSubmission",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    name = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    email = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    phone = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    message = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    isResolved = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP")
                },
                constraints: table =>
                {
                    table.PrimaryKey("ContactSubmission_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Faculty",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    slug = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    name = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    designation = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    department = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    location = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    researchFocus = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    educationSnippet = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    office = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    email = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    phone = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    cvUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    labWebsiteUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    orcid = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    googleScholarUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    researchGateUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    linkedinUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    publicationsCount = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    citationsCount = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    hIndex = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    patentsCount = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    projectsCount = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    researchAreas = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    overviewContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    educationContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    researchContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    publicationsContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    booksContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    patentsContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    awardsContent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    IsArchived = table.Column<bool>(type: "bit", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("Faculty_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "FooterLink",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    column = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    label = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    url = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("FooterLink_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "GalleryCategory",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    name = table.Column<string>(type: "nvarchar(450)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("GalleryCategory_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "GlobalSettings",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    siteName = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    logoUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    contactEmail = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    contactPhone = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    address = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    mapLink = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    facebookUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    twitterUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    linkedinUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    copyrightText = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    preFooterViewAllActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    preFooterViewAllText = table.Column<string>(type: "nvarchar(max)", nullable: true, defaultValueSql: "'VIEW ALL'"),
                    preFooterViewAllUrl = table.Column<string>(type: "nvarchar(max)", nullable: true, defaultValueSql: "'#'"),
                    workingHours = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isSearchEnabled = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    virtualTourActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    virtualTourText = table.Column<string>(type: "nvarchar(max)", nullable: true, defaultValueSql: "'VIRTUAL TOUR'"),
                    virtualTourUrl = table.Column<string>(type: "nvarchar(max)", nullable: true, defaultValueSql: "'#'")
                },
                constraints: table =>
                {
                    table.PrimaryKey("GlobalSettings_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "HeroSlide",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    TitleHi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    subtitle = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    SubtitleHi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    type = table.Column<string>(type: "nvarchar(max)", nullable: false, defaultValueSql: "'IMAGE'"),
                    mediaUrl = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    posterUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    isActiveVideo = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    routeUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ReviewStatus = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Remarks = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    showText = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    IsArchived = table.Column<bool>(type: "bit", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("HeroSlide_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "HomeSection",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    sectionType = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    subtitle = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    description = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ctaText = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ctaLink = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    metadata = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("HomeSection_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "InternationalCollaboration",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    link = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("InternationalCollaboration_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "LifeAtThstiItem",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    category = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    description = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    buttonText = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    buttonLink = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isExternal = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    metadata = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("LifeAtThstiItem_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "MarqueeItem",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    url = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("MarqueeItem_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Media",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    filename = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    url = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    mimeType = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    size = table.Column<int>(type: "int", nullable: false),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    altText = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    storagePath = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("Media_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Menu",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    label = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    route = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    order = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    parentId = table.Column<long>(type: "bigint", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isExternal = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    isVisible = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    targetBlank = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    location = table.Column<string>(type: "nvarchar(max)", nullable: false, defaultValueSql: "'HEADER'"),
                    isMegaMenu = table.Column<bool>(type: "bit", nullable: false, defaultValue: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("Menu_pkey", x => x.id);
                    table.ForeignKey(
                        name: "Menu_parentId_fkey",
                        column: x => x.parentId,
                        principalTable: "Menu",
                        principalColumn: "id");
                });

            migrationBuilder.CreateTable(
                name: "News",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    TitleHi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    slug = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    summary = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    content = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    ContentHi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    publishDate = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isFeatured = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    ReviewStatus = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Remarks = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    IsArchived = table.Column<bool>(type: "bit", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("News_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Notification",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    summary = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    url = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    publishDate = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    isNew = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    buttonText = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    type = table.Column<string>(type: "nvarchar(450)", nullable: false, defaultValueSql: "'Announcements'")
                },
                constraints: table =>
                {
                    table.PrimaryKey("Notification_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "NotificationCategory",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    name = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP")
                },
                constraints: table =>
                {
                    table.PrimaryKey("NotificationCategory_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Page",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    slug = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    content = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    metaTitle = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    metaDescription = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ogImage = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("Page_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "PreFooterLink",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    url = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PreFooterLink_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Programme",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    slug = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    shortDescription = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    routeUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isExternal = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("Programme_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "ResearchCenter",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    slug = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    excerpt = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    content = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    routeUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isExternal = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("ResearchCenter_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "ResearchFacility",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    slug = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    excerpt = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    content = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    routeUrl = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    isExternal = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    openInNewTab = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    displayOrder = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("ResearchFacility_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Tenders",
                columns: table => new
                {
                    Id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    TitleHi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ReferenceNo = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    PublishDate = table.Column<DateTime>(type: "datetime2", nullable: false),
                    ClosingDate = table.Column<DateTime>(type: "datetime2", nullable: false),
                    DocumentUrl = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    IsArchived = table.Column<bool>(type: "bit", nullable: false),
                    ReviewStatus = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Remarks = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    CreatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    UpdatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Tenders", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "TranslationLanguage",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    code = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    label = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    order = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("TranslationLanguage_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "User",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    email = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    password = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    name = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP"),
                    updatedAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    CreatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    UpdatedBy = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    failedLoginAttempts = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    forcePasswordChange = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true),
                    isLocked = table.Column<bool>(type: "bit", nullable: false, defaultValue: false),
                    lastLoginAt = table.Column<DateTime>(type: "datetime2", nullable: true),
                    lockedUntil = table.Column<DateTime>(type: "datetime2", nullable: true),
                    passwordUpdatedAt = table.Column<DateTime>(type: "datetime2", nullable: true),
                    mobile = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    username = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    role = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("User_pkey", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "Gallery",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    title = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    imageUrl = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    categoryId = table.Column<long>(type: "bigint", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP")
                },
                constraints: table =>
                {
                    table.PrimaryKey("Gallery_pkey", x => x.id);
                    table.ForeignKey(
                        name: "Gallery_categoryId_fkey",
                        column: x => x.categoryId,
                        principalTable: "GalleryCategory",
                        principalColumn: "id");
                });

            migrationBuilder.CreateTable(
                name: "AuthAuditLog",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    userId = table.Column<long>(type: "bigint", nullable: true),
                    email = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    ip = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    userAgent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    reason = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP")
                },
                constraints: table =>
                {
                    table.PrimaryKey("AuthAuditLog_pkey", x => x.id);
                    table.ForeignKey(
                        name: "AuthAuditLog_userId_fkey",
                        column: x => x.userId,
                        principalTable: "User",
                        principalColumn: "id");
                });

            migrationBuilder.CreateTable(
                name: "PasswordResetToken",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    userId = table.Column<long>(type: "bigint", nullable: false),
                    tokenHash = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    expiresAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    usedAt = table.Column<DateTime>(type: "datetime2", nullable: true),
                    requestedIp = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    userAgent = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP")
                },
                constraints: table =>
                {
                    table.PrimaryKey("PasswordResetToken_pkey", x => x.id);
                    table.ForeignKey(
                        name: "PasswordResetToken_userId_fkey",
                        column: x => x.userId,
                        principalTable: "User",
                        principalColumn: "id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "RefreshToken",
                columns: table => new
                {
                    id = table.Column<long>(type: "bigint", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    tokenHash = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    userId = table.Column<long>(type: "bigint", nullable: false),
                    expiresAt = table.Column<DateTime>(type: "datetime2", nullable: false),
                    revokedAt = table.Column<DateTime>(type: "datetime2", nullable: true),
                    createdAt = table.Column<DateTime>(type: "datetime2", nullable: false, defaultValueSql: "CURRENT_TIMESTAMP")
                },
                constraints: table =>
                {
                    table.PrimaryKey("RefreshToken_pkey", x => x.id);
                    table.ForeignKey(
                        name: "RefreshToken_userId_fkey",
                        column: x => x.userId,
                        principalTable: "User",
                        principalColumn: "id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_AdminModule_parentId",
                table: "AdminModule",
                column: "parentId");

            migrationBuilder.CreateIndex(
                name: "AuthAuditLog_email_createdAt_idx",
                table: "AuthAuditLog",
                columns: new[] { "email", "createdAt" });

            migrationBuilder.CreateIndex(
                name: "AuthAuditLog_userId_createdAt_idx",
                table: "AuthAuditLog",
                columns: new[] { "userId", "createdAt" });

            migrationBuilder.CreateIndex(
                name: "Faculty_slug_key",
                table: "Faculty",
                column: "slug",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "FooterLink_isActive_column_displayOrder_idx",
                table: "FooterLink",
                columns: new[] { "isActive", "column", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "IX_Gallery_categoryId",
                table: "Gallery",
                column: "categoryId");

            migrationBuilder.CreateIndex(
                name: "GalleryCategory_name_key",
                table: "GalleryCategory",
                column: "name",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "HeroSlide_isActive_displayOrder_idx",
                table: "HeroSlide",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "HomeSection_isActive_idx",
                table: "HomeSection",
                column: "isActive");

            migrationBuilder.CreateIndex(
                name: "LifeAtThstiItem_isActive_displayOrder_idx",
                table: "LifeAtThstiItem",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "MarqueeItem_isActive_displayOrder_idx",
                table: "MarqueeItem",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "IX_Menu_parentId",
                table: "Menu",
                column: "parentId");

            migrationBuilder.CreateIndex(
                name: "Menu_isActive_isVisible_idx",
                table: "Menu",
                columns: new[] { "isActive", "isVisible" });

            migrationBuilder.CreateIndex(
                name: "Menu_order_idx",
                table: "Menu",
                column: "order");

            migrationBuilder.CreateIndex(
                name: "News_isActive_publishDate_idx",
                table: "News",
                columns: new[] { "isActive", "publishDate" });

            migrationBuilder.CreateIndex(
                name: "News_slug_key",
                table: "News",
                column: "slug",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "Notification_isActive_type_displayOrder_idx",
                table: "Notification",
                columns: new[] { "isActive", "type", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "NotificationCategory_name_key",
                table: "NotificationCategory",
                column: "name",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "Page_isActive_idx",
                table: "Page",
                column: "isActive");

            migrationBuilder.CreateIndex(
                name: "Page_slug_key",
                table: "Page",
                column: "slug",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "PasswordResetToken_tokenHash_idx",
                table: "PasswordResetToken",
                column: "tokenHash");

            migrationBuilder.CreateIndex(
                name: "PasswordResetToken_tokenHash_key",
                table: "PasswordResetToken",
                column: "tokenHash",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "PasswordResetToken_userId_idx",
                table: "PasswordResetToken",
                column: "userId");

            migrationBuilder.CreateIndex(
                name: "PreFooterLink_isActive_displayOrder_idx",
                table: "PreFooterLink",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "Programme_isActive_displayOrder_idx",
                table: "Programme",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "Programme_slug_key",
                table: "Programme",
                column: "slug",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "RefreshToken_tokenHash_idx",
                table: "RefreshToken",
                column: "tokenHash");

            migrationBuilder.CreateIndex(
                name: "RefreshToken_tokenHash_key",
                table: "RefreshToken",
                column: "tokenHash",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "RefreshToken_userId_idx",
                table: "RefreshToken",
                column: "userId");

            migrationBuilder.CreateIndex(
                name: "ResearchCenter_isActive_displayOrder_idx",
                table: "ResearchCenter",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "ResearchCenter_slug_key",
                table: "ResearchCenter",
                column: "slug",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "ResearchFacility_isActive_displayOrder_idx",
                table: "ResearchFacility",
                columns: new[] { "isActive", "displayOrder" });

            migrationBuilder.CreateIndex(
                name: "ResearchFacility_slug_key",
                table: "ResearchFacility",
                column: "slug",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "TranslationLanguage_code_key",
                table: "TranslationLanguage",
                column: "code",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "User_email_key",
                table: "User",
                column: "email",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "User_username_idx",
                table: "User",
                column: "username");

            migrationBuilder.CreateIndex(
                name: "User_username_key",
                table: "User",
                column: "username",
                unique: true);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "_prisma_migrations");

            migrationBuilder.DropTable(
                name: "AdminModule");

            migrationBuilder.DropTable(
                name: "AuthAuditLog");

            migrationBuilder.DropTable(
                name: "ContactSubmission");

            migrationBuilder.DropTable(
                name: "Faculty");

            migrationBuilder.DropTable(
                name: "FooterLink");

            migrationBuilder.DropTable(
                name: "Gallery");

            migrationBuilder.DropTable(
                name: "GlobalSettings");

            migrationBuilder.DropTable(
                name: "HeroSlide");

            migrationBuilder.DropTable(
                name: "HomeSection");

            migrationBuilder.DropTable(
                name: "InternationalCollaboration");

            migrationBuilder.DropTable(
                name: "LifeAtThstiItem");

            migrationBuilder.DropTable(
                name: "MarqueeItem");

            migrationBuilder.DropTable(
                name: "Media");

            migrationBuilder.DropTable(
                name: "Menu");

            migrationBuilder.DropTable(
                name: "News");

            migrationBuilder.DropTable(
                name: "Notification");

            migrationBuilder.DropTable(
                name: "NotificationCategory");

            migrationBuilder.DropTable(
                name: "Page");

            migrationBuilder.DropTable(
                name: "PasswordResetToken");

            migrationBuilder.DropTable(
                name: "PreFooterLink");

            migrationBuilder.DropTable(
                name: "Programme");

            migrationBuilder.DropTable(
                name: "RefreshToken");

            migrationBuilder.DropTable(
                name: "ResearchCenter");

            migrationBuilder.DropTable(
                name: "ResearchFacility");

            migrationBuilder.DropTable(
                name: "Tenders");

            migrationBuilder.DropTable(
                name: "TranslationLanguage");

            migrationBuilder.DropTable(
                name: "GalleryCategory");

            migrationBuilder.DropTable(
                name: "User");
        }
    }
}
