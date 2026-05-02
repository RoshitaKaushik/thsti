const fs = require('fs');
const path = 'c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\thsti-web\\src\\pages\\About.jsx';

let content = fs.readFileSync(path, 'utf8');

// Fix ASSETS_BASE_URL import path
content = content.replace("import { ASSETS_BASE_URL } from '../../config/env';", "import { ASSETS_BASE_URL } from '../config/env';");

// Fix counters
content = content.replace('<span className="count-text" data-speed="2000" data-stop="25">0</span>+', '<span className="count-text" data-speed="2000" data-stop="25">25</span>+');
content = content.replace('<span className="count-text" data-speed="2500" data-stop="36">0</span>', '<span className="count-text" data-speed="2500" data-stop="36">36</span>');
content = content.replace('<span className="count-text" data-speed="3000" data-stop="105">0</span>', '<span className="count-text" data-speed="3000" data-stop="105">105</span>');

// Add React hook for Accordion
content = content.replace("import React, { useEffect } from 'react';", "import React, { useEffect, useState } from 'react';");
content = content.replace("const About = () => {", "const About = () => {\n    const [activeFaq, setActiveFaq] = useState(1);");

// Replace the accordion blocks
content = content.replace(
    /<li className="accordion block ">[\s\S]*?<div className="acc-btn"><div className="icon-outer">.*?<\/div>Leading industrial solutions with best machinery<\/div>[\s\S]*?<\/li>/,
    `<li className={\`accordion block \${activeFaq === 0 ? 'active-block' : ''}\`}>
                                <div className={\`acc-btn \${activeFaq === 0 ? 'active' : ''}\`} onClick={() => setActiveFaq(0)} style={{ cursor: 'pointer' }}>
                                    <div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>
                                    Leading industrial solutions with best machinery
                                </div>
                                <div className={\`acc-content \${activeFaq === 0 ? 'current' : ''}\`} style={{ display: activeFaq === 0 ? 'block' : 'none' }}>
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>`
);

content = content.replace(
    /<li className="accordion block active-block ">[\s\S]*?<div className="acc-btn active"><div className="icon-outer">.*?<\/div>Accurate responses to client’s requirments<\/div>[\s\S]*?<\/li>/,
    `<li className={\`accordion block \${activeFaq === 1 ? 'active-block' : ''}\`}>
                                <div className={\`acc-btn \${activeFaq === 1 ? 'active' : ''}\`} onClick={() => setActiveFaq(1)} style={{ cursor: 'pointer' }}>
                                    <div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>
                                    Accurate responses to client’s requirments
                                </div>
                                <div className={\`acc-content \${activeFaq === 1 ? 'current' : ''}\`} style={{ display: activeFaq === 1 ? 'block' : 'none' }}>
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>`
);

content = content.replace(
    /<li className="accordion block ">[\s\S]*?<div className="acc-btn"><div className="icon-outer">.*?<\/div>World’s leader in engineering business<\/div>[\s\S]*?<\/li>/,
    `<li className={\`accordion block \${activeFaq === 2 ? 'active-block' : ''}\`}>
                                <div className={\`acc-btn \${activeFaq === 2 ? 'active' : ''}\`} onClick={() => setActiveFaq(2)} style={{ cursor: 'pointer' }}>
                                    <div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>
                                    World’s leader in engineering business
                                </div>
                                <div className={\`acc-content \${activeFaq === 2 ? 'current' : ''}\`} style={{ display: activeFaq === 2 ? 'block' : 'none' }}>
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>`
);

content = content.replace(
    /<li className="accordion block ">[\s\S]*?<div className="acc-btn"><div className="icon-outer">.*?<\/div>Solustrid has potential to find efficient solutions<\/div>[\s\S]*?<\/li>/,
    `<li className={\`accordion block \${activeFaq === 3 ? 'active-block' : ''}\`}>
                                <div className={\`acc-btn \${activeFaq === 3 ? 'active' : ''}\`} onClick={() => setActiveFaq(3)} style={{ cursor: 'pointer' }}>
                                    <div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>
                                    Solustrid has potential to find efficient solutions
                                </div>
                                <div className={\`acc-content \${activeFaq === 3 ? 'current' : ''}\`} style={{ display: activeFaq === 3 ? 'block' : 'none' }}>
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>`
);

// Fix links to internal pages that were 404ing like index.html -> /
content = content.replace(/href="index\.html"/g, 'href="/"');
// We leave other hrefs like "services-1.html" alone as they might be handled differently or requested by the user to match exactly.

fs.writeFileSync(path, content);
console.log("Successfully fixed About.jsx using regex.");
