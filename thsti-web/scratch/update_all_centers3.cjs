const fs = require('fs');
const { execSync } = require('child_process');

try {
    const rawContent = fs.readFileSync('scratch/maternal_new_content.txt', 'utf8');
    
    const sqlSafeContent = rawContent.replace(/'/g, "''");
    
    // Update all ResearchCenters back to just the raw content (without the prepended image)
    const sqlQuery = `
        UPDATE ResearchCenter 
        SET Content = '${sqlSafeContent}'
    `;
    
    fs.writeFileSync('scratch/update_all_centers3.sql', sqlQuery);
    console.log('SQL file written successfully.');
    
    execSync('sqlcmd -S localhost\\SQLEXPRESS -E -d thsti_dev -C -i scratch/update_all_centers3.sql');
    console.log('Database updated successfully for all centers (removed inline image).');
} catch (error) {
    console.error('Error updating database:', error.message);
}
