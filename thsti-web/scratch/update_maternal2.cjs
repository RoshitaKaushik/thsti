const fs = require('fs');
const { execSync } = require('child_process');

try {
    const rawContent = fs.readFileSync('scratch/maternal_new_content.txt', 'utf8');
    
    // Add the image and the wrapper back to the start of the content
    const fullContent = `
        <div class="image mb-4">
            <img src="images/resource/baby-2.png" alt="" style="width: 100%; height: auto; border-radius: 4px;" />
        </div>
        ${rawContent}
    `;
    
    const sqlSafeContent = fullContent.replace(/'/g, "''");
    
    const sqlQuery = `
        UPDATE ResearchCenter 
        SET Content = '${sqlSafeContent}',
            ImageUrl = 'images/background/baby-1.png'
        WHERE Title LIKE '%Maternal%'
    `;
    
    fs.writeFileSync('scratch/update_maternal2.sql', sqlQuery);
    console.log('SQL file written successfully.');
    
    execSync('sqlcmd -S localhost\\SQLEXPRESS -E -d thsti_dev -C -i scratch/update_maternal2.sql');
    console.log('Database updated successfully.');
} catch (error) {
    console.error('Error updating database:', error.message);
}
