const fs = require('fs');
const path = 'c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\thsti-web\\src\\pages\\About.jsx';

let content = fs.readFileSync(path, 'utf8');

// Fix ASSETS_BASE_URL import path
content = content.replace("import { ASSETS_BASE_URL } from '../../config/env';", "import { ASSETS_BASE_URL } from '../config/env';");

// Fix counters
content = content.replace('<span className="count-text" data-speed="2000" data-stop="25">0</span>+', '<span className="count-text" data-speed="2000" data-stop="25">25</span>+');
content = content.replace('<span className="count-text" data-speed="2500" data-stop="36">0</span>', '<span className="count-text" data-speed="2500" data-stop="36">36</span>');
content = content.replace('<span className="count-text" data-speed="3000" data-stop="105">0</span>', '<span className="count-text" data-speed="3000" data-stop="105">105</span>');

// Fix home breadcrumb link
content = content.replace(/href="index\.html"/g, 'href="/"');

fs.writeFileSync(path, content);
console.log("Successfully fixed About.jsx using clean script.");
