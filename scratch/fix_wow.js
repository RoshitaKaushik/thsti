const fs = require('fs');

const jsxPath = 'c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\thsti-web\\src\\pages\\About.jsx';
let jsxContent = fs.readFileSync(jsxPath, 'utf8');

// Remove WOW classes
const classesToRemove = [
    'wow fadeInLeft', 'wow fadeInRight', 'wow fadeInUp', 'wow fadeInRightBig', 
    'wow', 'fadeInLeft', 'fadeInRight', 'fadeInUp', 'fadeInRightBig'
];

classesToRemove.forEach(cls => {
    // Replace class with spaces around it
    const regex = new RegExp(`\\s+${cls}\\b`, 'g');
    jsxContent = jsxContent.replace(regex, '');
});

// Also fix image URLs to use ASSETS_BASE_URL just in case Vite is not serving /images correctly
jsxContent = jsxContent.replace(/`url\(\/images/g, '`url(${ASSETS_BASE_URL}images');
jsxContent = jsxContent.replace(/src={`\/images/g, 'src={`${ASSETS_BASE_URL}images');

// Add import for ASSETS_BASE_URL if not present
if (!jsxContent.includes('ASSETS_BASE_URL')) {
    jsxContent = jsxContent.replace(
        "import { Link } from 'react-router-dom';", 
        "import { Link } from 'react-router-dom';\nimport { ASSETS_BASE_URL } from '../../config/env';"
    );
}

fs.writeFileSync(jsxPath, jsxContent);
console.log("Successfully removed WOW classes and fixed image URLs in About.jsx!");
