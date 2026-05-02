const fs = require('fs');
const path = 'c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\thsti-web\\src\\pages\\About.jsx';

let content = fs.readFileSync(path, 'utf8');

// Revert ASSETS_BASE_URL for static template images
content = content.replace(/\$\{ASSETS_BASE_URL\}images/g, '/images');

// Optionally remove the ASSETS_BASE_URL import if it's no longer used
content = content.replace("import { ASSETS_BASE_URL } from '../config/env';\n", "");

fs.writeFileSync(path, content);
console.log("Successfully reverted image URLs in About.jsx to use local public folder.");
