const fs = require('fs');
let content = fs.readFileSync('Models/ThstiDbContext.cs', 'utf8');

// Remove UseNpgsql
content = content.replace(/=>\s*optionsBuilder\.UseNpgsql\([^)]+\);/g, '=> optionsBuilder.UseSqlServer("Server=localhost;Database=thsti_dev;Integrated Security=True;TrustServerCertificate=True;");');

// Remove PostgreSQL Enums
content = content.replace(/\.HasPostgresEnum\([^)]+\)/g, '');

// Remove all HasColumnType("timestamp...")
content = content.replace(/\.HasColumnType\("timestamp[^"]*"\)/g, '');

// Remove all HasColumnType("jsonb")
content = content.replace(/\.HasColumnType\("jsonb"\)/g, '');

// Replace PostgreSQL casts ::text
content = content.replace(/::text/g, '');

// Replace boolean defaults that might cause issues (not necessary usually, but good measure)
content = content.replace(/now\(\)/g, 'GETDATE()');

fs.writeFileSync('Models/ThstiDbContext.cs', content);
console.log('Fixed Models/ThstiDbContext.cs');
