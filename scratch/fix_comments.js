const fs = require('fs');

const jsxPath = 'c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\thsti-web\\src\\pages\\About.jsx';
let jsxContent = fs.readFileSync(jsxPath, 'utf8');

// Replace HTML comments with JSX comments
jsxContent = jsxContent.replace(/<!--([\s\S]*?)-->/g, '{/* $1 */}');

// Also remove the extra spaces around style props just in case
fs.writeFileSync(jsxPath, jsxContent);
console.log("Successfully fixed About.jsx comments!");
