const fs = require('fs');
const { execSync } = require('child_process');

try {
    const rawContent = fs.readFileSync('scratch/maternal_new_content.txt', 'utf8');
    
    // We need to properly escape single quotes for SQL Server
    const sqlSafeContent = rawContent.replace(/'/g, "''");
    
    const sqlQuery = `
        UPDATE ResearchCenter 
        SET Content = '${sqlSafeContent}',
            ImageUrl = 'images/background/baby-1.png'
        WHERE Title LIKE '%Maternal%'
    `;
    
    fs.writeFileSync('scratch/update_maternal.sql', sqlQuery);
    console.log('SQL file written successfully.');
    
    execSync('sqlcmd -S localhost\\SQLEXPRESS -E -d thsti_dev -C -i scratch/update_maternal.sql');
    console.log('Database updated successfully.');
} catch (error) {
    console.error('Error updating database:', error.message);
}
