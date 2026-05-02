CREATE TABLE [_prisma_migrations] (
    [id] nvarchar(36) NOT NULL,
    [checksum] nvarchar(64) NOT NULL,
    [finished_at] datetime2 NULL,
    [migration_name] nvarchar(255) NOT NULL,
    [logs] nvarchar(max) NULL,
    [rolled_back_at] datetime2 NULL,
    [started_at] datetime2 NOT NULL DEFAULT (GETDATE()),
    [applied_steps_count] int NOT NULL DEFAULT 0,
    CONSTRAINT [_prisma_migrations_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [AdminModule] (
    [id] int NOT NULL IDENTITY,
    [name] nvarchar(max) NOT NULL,
    [path] nvarchar(max) NOT NULL,
    [iconName] nvarchar(max) NOT NULL,
    [order] int NOT NULL DEFAULT 0,
    [parentId] int NULL,
    [allowedRoles] nvarchar(max) NOT NULL DEFAULT N'ADMIN',
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    CONSTRAINT [PK_AdminModule] PRIMARY KEY ([id]),
    CONSTRAINT [FK_AdminModule_AdminModule_parentId] FOREIGN KEY ([parentId]) REFERENCES [AdminModule] ([id])
);
GO


CREATE TABLE [ContactSubmission] (
    [id] int NOT NULL IDENTITY,
    [name] nvarchar(max) NOT NULL,
    [email] nvarchar(max) NOT NULL,
    [phone] nvarchar(max) NULL,
    [message] nvarchar(max) NOT NULL,
    [isResolved] bit NOT NULL DEFAULT CAST(0 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    CONSTRAINT [ContactSubmission_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Faculty] (
    [id] int NOT NULL IDENTITY,
    [slug] nvarchar(450) NOT NULL,
    [name] nvarchar(max) NOT NULL,
    [designation] nvarchar(max) NULL,
    [department] nvarchar(max) NULL,
    [location] nvarchar(max) NULL,
    [researchFocus] nvarchar(max) NULL,
    [educationSnippet] nvarchar(max) NULL,
    [office] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [email] nvarchar(max) NULL,
    [phone] nvarchar(max) NULL,
    [cvUrl] nvarchar(max) NULL,
    [labWebsiteUrl] nvarchar(max) NULL,
    [orcid] nvarchar(max) NULL,
    [googleScholarUrl] nvarchar(max) NULL,
    [researchGateUrl] nvarchar(max) NULL,
    [linkedinUrl] nvarchar(max) NULL,
    [publicationsCount] int NOT NULL DEFAULT 0,
    [citationsCount] int NOT NULL DEFAULT 0,
    [hIndex] int NOT NULL DEFAULT 0,
    [patentsCount] int NOT NULL DEFAULT 0,
    [projectsCount] int NOT NULL DEFAULT 0,
    [researchAreas] nvarchar(max) NULL,
    [overviewContent] nvarchar(max) NULL,
    [educationContent] nvarchar(max) NULL,
    [researchContent] nvarchar(max) NULL,
    [publicationsContent] nvarchar(max) NULL,
    [booksContent] nvarchar(max) NULL,
    [patentsContent] nvarchar(max) NULL,
    [awardsContent] nvarchar(max) NULL,
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [IsArchived] bit NOT NULL,
    CONSTRAINT [Faculty_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [FooterLink] (
    [id] int NOT NULL IDENTITY,
    [column] nvarchar(450) NOT NULL,
    [label] nvarchar(max) NOT NULL,
    [url] nvarchar(max) NOT NULL,
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [FooterLink_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [GalleryCategory] (
    [id] int NOT NULL IDENTITY,
    [name] nvarchar(450) NOT NULL,
    CONSTRAINT [GalleryCategory_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [GlobalSettings] (
    [id] int NOT NULL IDENTITY,
    [siteName] nvarchar(max) NOT NULL,
    [logoUrl] nvarchar(max) NULL,
    [contactEmail] nvarchar(max) NULL,
    [contactPhone] nvarchar(max) NULL,
    [address] nvarchar(max) NULL,
    [mapLink] nvarchar(max) NULL,
    [facebookUrl] nvarchar(max) NULL,
    [twitterUrl] nvarchar(max) NULL,
    [linkedinUrl] nvarchar(max) NULL,
    [copyrightText] nvarchar(max) NULL,
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [preFooterViewAllActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [preFooterViewAllText] nvarchar(max) NULL DEFAULT ('VIEW ALL'),
    [preFooterViewAllUrl] nvarchar(max) NULL DEFAULT ('#'),
    [workingHours] nvarchar(max) NULL,
    [isSearchEnabled] bit NOT NULL DEFAULT CAST(1 AS bit),
    [virtualTourActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [virtualTourText] nvarchar(max) NULL DEFAULT ('VIRTUAL TOUR'),
    [virtualTourUrl] nvarchar(max) NULL DEFAULT ('#'),
    CONSTRAINT [GlobalSettings_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [HeroSlide] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NULL,
    [TitleHi] nvarchar(max) NULL,
    [subtitle] nvarchar(max) NULL,
    [SubtitleHi] nvarchar(max) NULL,
    [type] nvarchar(max) NOT NULL DEFAULT ('IMAGE'),
    [mediaUrl] nvarchar(max) NOT NULL,
    [posterUrl] nvarchar(max) NULL,
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [isActiveVideo] bit NOT NULL DEFAULT CAST(0 AS bit),
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [routeUrl] nvarchar(max) NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [ReviewStatus] nvarchar(max) NOT NULL,
    [Remarks] nvarchar(max) NULL,
    [showText] bit NOT NULL DEFAULT CAST(1 AS bit),
    [IsArchived] bit NOT NULL,
    CONSTRAINT [HeroSlide_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [HomeSection] (
    [id] int NOT NULL IDENTITY,
    [sectionType] nvarchar(max) NOT NULL,
    [title] nvarchar(max) NULL,
    [subtitle] nvarchar(max) NULL,
    [description] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [ctaText] nvarchar(max) NULL,
    [ctaLink] nvarchar(max) NULL,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [metadata] nvarchar(max) NULL,
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [HomeSection_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [InternationalCollaboration] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [imageUrl] nvarchar(max) NULL,
    [link] nvarchar(max) NULL,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [InternationalCollaboration_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [LifeAtThstiItem] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [category] nvarchar(max) NULL,
    [description] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [buttonText] nvarchar(max) NULL,
    [buttonLink] nvarchar(max) NULL,
    [isExternal] bit NOT NULL DEFAULT CAST(0 AS bit),
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [metadata] nvarchar(max) NULL,
    CONSTRAINT [LifeAtThstiItem_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [MarqueeItem] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [url] nvarchar(max) NULL,
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [MarqueeItem_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Media] (
    [id] int NOT NULL IDENTITY,
    [filename] nvarchar(max) NOT NULL,
    [url] nvarchar(max) NOT NULL,
    [mimeType] nvarchar(max) NOT NULL,
    [size] int NOT NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [altText] nvarchar(max) NULL,
    [storagePath] nvarchar(max) NOT NULL,
    CONSTRAINT [Media_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Menu] (
    [id] int NOT NULL IDENTITY,
    [label] nvarchar(max) NOT NULL,
    [route] nvarchar(max) NULL,
    [order] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [parentId] int NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [isExternal] bit NOT NULL DEFAULT CAST(0 AS bit),
    [isVisible] bit NOT NULL DEFAULT CAST(1 AS bit),
    [targetBlank] bit NOT NULL DEFAULT CAST(0 AS bit),
    [location] nvarchar(max) NOT NULL DEFAULT ('HEADER'),
    [isMegaMenu] bit NOT NULL DEFAULT CAST(0 AS bit),
    CONSTRAINT [Menu_pkey] PRIMARY KEY ([id]),
    CONSTRAINT [Menu_parentId_fkey] FOREIGN KEY ([parentId]) REFERENCES [Menu] ([id])
);
GO


CREATE TABLE [News] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [TitleHi] nvarchar(max) NULL,
    [slug] nvarchar(450) NOT NULL,
    [summary] nvarchar(max) NULL,
    [content] nvarchar(max) NOT NULL,
    [ContentHi] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [publishDate] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [isFeatured] bit NOT NULL DEFAULT CAST(0 AS bit),
    [ReviewStatus] nvarchar(max) NOT NULL,
    [Remarks] nvarchar(max) NULL,
    [IsArchived] bit NOT NULL,
    CONSTRAINT [News_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Notification] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [summary] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [url] nvarchar(max) NULL,
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [publishDate] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [isNew] bit NOT NULL DEFAULT CAST(0 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [buttonText] nvarchar(max) NULL,
    [type] nvarchar(450) NOT NULL DEFAULT ('Announcements'),
    CONSTRAINT [Notification_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [NotificationCategory] (
    [id] int NOT NULL IDENTITY,
    [name] nvarchar(450) NOT NULL,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    CONSTRAINT [NotificationCategory_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Page] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [slug] nvarchar(450) NOT NULL,
    [content] nvarchar(max) NOT NULL,
    [metaTitle] nvarchar(max) NULL,
    [metaDescription] nvarchar(max) NULL,
    [ogImage] nvarchar(max) NULL,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [Page_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [PreFooterLink] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [url] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [PreFooterLink_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Programme] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [slug] nvarchar(450) NOT NULL,
    [shortDescription] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [routeUrl] nvarchar(max) NULL,
    [isExternal] bit NOT NULL DEFAULT CAST(0 AS bit),
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [Programme_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [ResearchCenter] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [slug] nvarchar(450) NOT NULL,
    [excerpt] nvarchar(max) NULL,
    [content] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [routeUrl] nvarchar(max) NULL,
    [isExternal] bit NOT NULL DEFAULT CAST(0 AS bit),
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [ResearchCenter_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [ResearchFacility] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NOT NULL,
    [slug] nvarchar(450) NOT NULL,
    [excerpt] nvarchar(max) NULL,
    [content] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NULL,
    [routeUrl] nvarchar(max) NULL,
    [isExternal] bit NOT NULL DEFAULT CAST(0 AS bit),
    [openInNewTab] bit NOT NULL DEFAULT CAST(0 AS bit),
    [displayOrder] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [ResearchFacility_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Tenders] (
    [Id] int NOT NULL IDENTITY,
    [Title] nvarchar(max) NOT NULL,
    [TitleHi] nvarchar(max) NULL,
    [ReferenceNo] nvarchar(max) NOT NULL,
    [PublishDate] datetime2 NOT NULL,
    [ClosingDate] datetime2 NOT NULL,
    [DocumentUrl] nvarchar(max) NOT NULL,
    [IsArchived] bit NOT NULL,
    [ReviewStatus] nvarchar(max) NOT NULL,
    [Remarks] nvarchar(max) NULL,
    [CreatedAt] datetime2 NOT NULL,
    [UpdatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [PK_Tenders] PRIMARY KEY ([Id])
);
GO


CREATE TABLE [TranslationLanguage] (
    [id] int NOT NULL IDENTITY,
    [code] nvarchar(450) NOT NULL,
    [label] nvarchar(max) NOT NULL,
    [order] int NOT NULL DEFAULT 0,
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    CONSTRAINT [TranslationLanguage_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [User] (
    [id] int NOT NULL IDENTITY,
    [email] nvarchar(450) NOT NULL,
    [password] nvarchar(max) NOT NULL,
    [name] nvarchar(max) NOT NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    [updatedAt] datetime2 NOT NULL,
    [CreatedBy] nvarchar(max) NULL,
    [UpdatedBy] nvarchar(max) NULL,
    [failedLoginAttempts] int NOT NULL DEFAULT 0,
    [forcePasswordChange] bit NOT NULL DEFAULT CAST(0 AS bit),
    [isActive] bit NOT NULL DEFAULT CAST(1 AS bit),
    [isLocked] bit NOT NULL DEFAULT CAST(0 AS bit),
    [lastLoginAt] datetime2 NULL,
    [lockedUntil] datetime2 NULL,
    [passwordUpdatedAt] datetime2 NULL,
    [mobile] nvarchar(max) NULL,
    [username] nvarchar(450) NOT NULL,
    [role] nvarchar(max) NOT NULL,
    CONSTRAINT [User_pkey] PRIMARY KEY ([id])
);
GO


CREATE TABLE [Gallery] (
    [id] int NOT NULL IDENTITY,
    [title] nvarchar(max) NULL,
    [imageUrl] nvarchar(max) NOT NULL,
    [categoryId] int NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    CONSTRAINT [Gallery_pkey] PRIMARY KEY ([id]),
    CONSTRAINT [Gallery_categoryId_fkey] FOREIGN KEY ([categoryId]) REFERENCES [GalleryCategory] ([id])
);
GO


CREATE TABLE [AuthAuditLog] (
    [id] int NOT NULL IDENTITY,
    [userId] int NULL,
    [email] nvarchar(450) NOT NULL,
    [ip] nvarchar(max) NULL,
    [userAgent] nvarchar(max) NULL,
    [reason] nvarchar(max) NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    CONSTRAINT [AuthAuditLog_pkey] PRIMARY KEY ([id]),
    CONSTRAINT [AuthAuditLog_userId_fkey] FOREIGN KEY ([userId]) REFERENCES [User] ([id])
);
GO


CREATE TABLE [PasswordResetToken] (
    [id] int NOT NULL IDENTITY,
    [userId] int NOT NULL,
    [tokenHash] nvarchar(450) NOT NULL,
    [expiresAt] datetime2 NOT NULL,
    [usedAt] datetime2 NULL,
    [requestedIp] nvarchar(max) NULL,
    [userAgent] nvarchar(max) NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    CONSTRAINT [PasswordResetToken_pkey] PRIMARY KEY ([id]),
    CONSTRAINT [PasswordResetToken_userId_fkey] FOREIGN KEY ([userId]) REFERENCES [User] ([id]) ON DELETE CASCADE
);
GO


CREATE TABLE [RefreshToken] (
    [id] int NOT NULL IDENTITY,
    [tokenHash] nvarchar(450) NOT NULL,
    [userId] int NOT NULL,
    [expiresAt] datetime2 NOT NULL,
    [revokedAt] datetime2 NULL,
    [createdAt] datetime2 NOT NULL DEFAULT (CURRENT_TIMESTAMP),
    CONSTRAINT [RefreshToken_pkey] PRIMARY KEY ([id]),
    CONSTRAINT [RefreshToken_userId_fkey] FOREIGN KEY ([userId]) REFERENCES [User] ([id]) ON DELETE CASCADE
);
GO


CREATE INDEX [IX_AdminModule_parentId] ON [AdminModule] ([parentId]);
GO


CREATE INDEX [AuthAuditLog_email_createdAt_idx] ON [AuthAuditLog] ([email], [createdAt]);
GO


CREATE INDEX [AuthAuditLog_userId_createdAt_idx] ON [AuthAuditLog] ([userId], [createdAt]);
GO


CREATE UNIQUE INDEX [Faculty_slug_key] ON [Faculty] ([slug]);
GO


CREATE INDEX [FooterLink_isActive_column_displayOrder_idx] ON [FooterLink] ([isActive], [column], [displayOrder]);
GO


CREATE INDEX [IX_Gallery_categoryId] ON [Gallery] ([categoryId]);
GO


CREATE UNIQUE INDEX [GalleryCategory_name_key] ON [GalleryCategory] ([name]);
GO


CREATE INDEX [HeroSlide_isActive_displayOrder_idx] ON [HeroSlide] ([isActive], [displayOrder]);
GO


CREATE INDEX [HomeSection_isActive_idx] ON [HomeSection] ([isActive]);
GO


CREATE INDEX [LifeAtThstiItem_isActive_displayOrder_idx] ON [LifeAtThstiItem] ([isActive], [displayOrder]);
GO


CREATE INDEX [MarqueeItem_isActive_displayOrder_idx] ON [MarqueeItem] ([isActive], [displayOrder]);
GO


CREATE INDEX [IX_Menu_parentId] ON [Menu] ([parentId]);
GO


CREATE INDEX [Menu_isActive_isVisible_idx] ON [Menu] ([isActive], [isVisible]);
GO


CREATE INDEX [Menu_order_idx] ON [Menu] ([order]);
GO


CREATE INDEX [News_isActive_publishDate_idx] ON [News] ([isActive], [publishDate]);
GO


CREATE UNIQUE INDEX [News_slug_key] ON [News] ([slug]);
GO


CREATE INDEX [Notification_isActive_type_displayOrder_idx] ON [Notification] ([isActive], [type], [displayOrder]);
GO


CREATE UNIQUE INDEX [NotificationCategory_name_key] ON [NotificationCategory] ([name]);
GO


CREATE INDEX [Page_isActive_idx] ON [Page] ([isActive]);
GO


CREATE UNIQUE INDEX [Page_slug_key] ON [Page] ([slug]);
GO


CREATE INDEX [PasswordResetToken_tokenHash_idx] ON [PasswordResetToken] ([tokenHash]);
GO


CREATE UNIQUE INDEX [PasswordResetToken_tokenHash_key] ON [PasswordResetToken] ([tokenHash]);
GO


CREATE INDEX [PasswordResetToken_userId_idx] ON [PasswordResetToken] ([userId]);
GO


CREATE INDEX [PreFooterLink_isActive_displayOrder_idx] ON [PreFooterLink] ([isActive], [displayOrder]);
GO


CREATE INDEX [Programme_isActive_displayOrder_idx] ON [Programme] ([isActive], [displayOrder]);
GO


CREATE UNIQUE INDEX [Programme_slug_key] ON [Programme] ([slug]);
GO


CREATE INDEX [RefreshToken_tokenHash_idx] ON [RefreshToken] ([tokenHash]);
GO


CREATE UNIQUE INDEX [RefreshToken_tokenHash_key] ON [RefreshToken] ([tokenHash]);
GO


CREATE INDEX [RefreshToken_userId_idx] ON [RefreshToken] ([userId]);
GO


CREATE INDEX [ResearchCenter_isActive_displayOrder_idx] ON [ResearchCenter] ([isActive], [displayOrder]);
GO


CREATE UNIQUE INDEX [ResearchCenter_slug_key] ON [ResearchCenter] ([slug]);
GO


CREATE INDEX [ResearchFacility_isActive_displayOrder_idx] ON [ResearchFacility] ([isActive], [displayOrder]);
GO


CREATE UNIQUE INDEX [ResearchFacility_slug_key] ON [ResearchFacility] ([slug]);
GO


CREATE UNIQUE INDEX [TranslationLanguage_code_key] ON [TranslationLanguage] ([code]);
GO


CREATE UNIQUE INDEX [User_email_key] ON [User] ([email]);
GO


CREATE INDEX [User_username_idx] ON [User] ([username]);
GO


CREATE UNIQUE INDEX [User_username_key] ON [User] ([username]);
GO


