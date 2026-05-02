const fs = require('fs');

const htmlContent = fs.readFileSync('c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\design9\\about.html', 'utf8');

// Extract the content between <!--Page Title--> and <!--Main Footer-->
const startIndex = htmlContent.indexOf('<!--Page Title-->');
const endIndex = htmlContent.indexOf('<!--Main Footer-->');
let mainContent = htmlContent.substring(startIndex, endIndex);

// Convert HTML to JSX
mainContent = mainContent.replace(/class=/g, 'className=');
mainContent = mainContent.replace(/for=/g, 'htmlFor=');
mainContent = mainContent.replace(/<img([^>]*)>/g, '<img$1 />');
mainContent = mainContent.replace(/<input([^>]*)>/g, '<input$1 />');
mainContent = mainContent.replace(/<br>/g, '<br />');
mainContent = mainContent.replace(/<hr>/g, '<hr />');

// Convert style attributes to React style objects
mainContent = mainContent.replace(/style="([^"]*)"/g, (match, styles) => {
    const styleObj = {};
    styles.split(';').forEach(style => {
        if (!style.trim()) return;
        const [key, value] = style.split(':');
        if (!key || !value) return;
        const camelCaseKey = key.trim().replace(/-([a-z])/g, (g) => g[1].toUpperCase());
        // Handle background-image:url(...)
        if (camelCaseKey === 'backgroundImage') {
            const urlMatch = value.match(/url\(([^)]+)\)/);
            if (urlMatch) {
                 styleObj[camelCaseKey] = `url(/${urlMatch[1].replace(/['"]/g, '')})`;
            } else {
                 styleObj[camelCaseKey] = value.trim();
            }
        } else {
            styleObj[camelCaseKey] = value.trim();
        }
    });
    return `style={${JSON.stringify(styleObj).replace(/"url\(\/([^)]+)\)"/, '`url(/$1)`')}}`;
});

// Update image paths to use getImageUrl
mainContent = mainContent.replace(/src="images\/([^"]*)"/g, 'src={`/images/$1`}');

const jsxTemplate = `import React, { useEffect } from 'react';
import { Link } from 'react-router-dom';

const About = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            ${mainContent}
        </>
    );
};

export default About;
`;

fs.writeFileSync('c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\thsti-web\\src\\pages\\About.jsx', jsxTemplate);
console.log("Successfully created About.jsx!");
