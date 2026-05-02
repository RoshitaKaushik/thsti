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
    
    // Update all ResearchCenters to have the template content.
    // They will retain their Title and Excerpt columns, but the inner content will be the template layout.
    const sqlQuery = `
        UPDATE ResearchCenter 
        SET Content = '${sqlSafeContent}',
            ImageUrl = 'images/background/baby-1.png'
    `;
    
    fs.writeFileSync('scratch/update_all_centers.sql', sqlQuery);
    console.log('SQL file written successfully.');
    
    execSync('sqlcmd -S localhost\\SQLEXPRESS -E -d thsti_dev -C -i scratch/update_all_centers.sql');
    console.log('Database updated successfully for all centers.');
} catch (error) {
    console.error('Error updating database:', error.message);
}
