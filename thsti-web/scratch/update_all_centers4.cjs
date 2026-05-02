const fs = require('fs');
const { execSync } = require('child_process');

try {
    const rawContent = fs.readFileSync('scratch/maternal_new_content2.txt', 'utf8');
    
    const sqlSafeContent = rawContent.replace(/'/g, "''");
    
    // Update all ResearchCenters back to just the raw content, with ALL closing tags intact!
    const sqlQuery = `
        UPDATE ResearchCenter 
        SET Content = '${sqlSafeContent}'
    `;
    
    fs.writeFileSync('scratch/update_all_centers4.sql', sqlQuery);
    console.log('SQL file written successfully.');
    
    execSync('sqlcmd -S localhost\\SQLEXPRESS -E -d thsti_dev -C -i scratch/update_all_centers4.sql');
    console.log('Database updated successfully for all centers with fixed closing tags.');
} catch (error) {
    console.error('Error updating database:', error.message);
}
