UPDATE ResearchCenter SET 
    RouteUrl = 'https://cdsa.thsti.in/',
    IsExternal = 1,
    OpenInNewTab = 1,
    UpdatedAt = GETUTCDATE()
WHERE Slug = 'clinical-development-services-agency';
GO
