export const parseCmsContent = (rawContent, pageTitle = '') => {
    if (!rawContent) return '';

    let cleanedContent = rawContent;
    try {
        // Strip out redundant leading title
        if (pageTitle) {
            const escapedTitle = pageTitle.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const titleRegex = new RegExp(`^[\\s\\S]{0,300}?(?:<h[1-6][^>]*>|<p[^>]*>)\\s*(?:<span[^>]*>|<strong[^>]*>|<b>|<i>)?\\s*(?:Research (?:Facility|Center)\\s*:\\s*)?${escapedTitle}\\s*(?:</(?:span|strong|b|i)>)?\\s*(?:</h[1-6]>|</p>)`, 'i');
            cleanedContent = cleanedContent.replace(titleRegex, '');
        }

        cleanedContent = cleanedContent
            // Fix: Remove database Mojibake (corrupted UTF-8 characters)
            .replace(/â€“/g, '–')
            .replace(/â€”/g, '—')
            .replace(/â€˜/g, '‘')
            .replace(/â€™/g, '’')
            .replace(/â€œ/g, '"')
            .replace(/â€ /g, '"')
            .replace(/â€/g, '"')
            .replace(/Â·/g, '•')
            .replace(/·/g, '•')
            .replace(/font-family:Symbol/gi, '')
            .replace(/margin-left\s*:\s*[^;"]+;?/gi, '')
            .replace(/text-indent\s*:\s*[^;"]+;?/gi, '')
            // Fix: Replace non-breaking spaces between words with normal spaces to allow text wrapping
            .replace(/([a-zA-Z.,;>])&nbsp;([a-zA-Z.,;<])/g, '$1 $2')
            // Fix: Ensure relative image paths resolve correctly on dynamic routes
            .replace(/src="images\//g, 'src="/images/')
            // Fix: Neutralize legacy Bootstrap container classes so they don't break the new sidebar layout
            .replace(/class=["']container["']/gi, 'class="w-100"')
            .replace(/class=["']row["']/gi, 'class="row mx-0"')
            // Fix: Hide broken images
            .replace(/<img([^>]*)>/gi, '<img$1 onerror="this.style.display=\'none\'">')
            
            // Transform Legacy Red/Blue Contact Box (<div class="row" style="background:#a8252b">)
            .replace(/<div[^>]*class=["']row["'][^>]*style=["'][^"']*(?:#a8252b|#9d302b)[^"']*["'][^>]*>([\s\S]*?)<\/div>(?:\s*<\/div>){0,2}/gi, (match, innerHtml) => {
                let name = "Contact Details";
                // Try to find a heading/name inside col-lg-12
                const nameMatch = innerHtml.match(/<div[^>]*col-lg-12[^>]*>[\s\S]*?(?:<span[^>]*>|<strong[^>]*>|<p[^>]*>)?\s*([^<]{3,50}?)\s*(?:<\/span>|<\/strong>|<\/p>)?[\s\S]*?<\/div>/i);
                if (nameMatch) {
                    name = nameMatch[1].trim();
                }

                // Extract all image lines (contact items)
                let contactLines = "";
                const lineRegex = /<p[^>]*>(?:&nbsp;|\s)*<img([^>]+)>(?:&nbsp;|\s)*([\s\S]*?)<\/p>/gi;
                let lineMatch;
                let foundLines = false;
                while ((lineMatch = lineRegex.exec(innerHtml)) !== null) {
                    foundLines = true;
                    // strip spans inside the text
                    let text = lineMatch[2].trim().replace(/<\/?span[^>]*>/gi, '');
                    contactLines += `<div class="d-flex align-items-center mb-2" style="gap: 12px;"><img${lineMatch[1]} style="width: 20px; height: 20px; object-fit: contain; flex-shrink: 0; border-radius: 50%;" /> <span style="font-size: 14.5px; color: #444; word-break: break-word; font-weight: 500;">${text}</span></div>`;
                }

                if (!foundLines) {
                    return match; // fallback if no contact lines found
                }

                return `<div class="contact-person-card mb-4 mt-4" style="background: #ffffff; border-radius: 12px; padding: 25px; border: 1px solid #edf1f7; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 450px;">
                    <h4 style="color: #002147; font-size: 1.1rem; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
                        <i class="fas fa-user-circle" style="color: #9E2A2B; font-size: 1.3rem;"></i> ${name}
                    </h4>
                    <div>${contactLines}</div>
                </div>`;
            })

            // Transform Plain Text Contact Blocks (Name + Contact Lines)
            .replace(/<p>(?:&nbsp;|\s)*<strong>([^<]+)<\/strong>(?:&nbsp;|\s)*<\/p>\s*((?:<p>(?:&nbsp;|\s)*<img[^>]+>(?:(?!<\/p>)[\s\S])+<\/p>\s*)+)/gi, (match, name, contactLines) => {
                const formattedLines = contactLines.replace(/<p>(?:&nbsp;|\s)*<img([^>]+)>(?:&nbsp;|\s)*([\s\S]*?)<\/p>/gi, (m, imgAttrs, text) => {
                    return `<div class="d-flex align-items-center mb-2" style="gap: 12px;"><img${imgAttrs} style="width: 20px; height: 20px; object-fit: contain; flex-shrink: 0; border-radius: 50%;" /> <span style="font-size: 14.5px; color: #444; word-break: break-word; font-weight: 500;">${text.trim()}</span></div>`;
                });
                return `<div class="contact-person-card mb-4 mt-4" style="background: #ffffff; border-radius: 12px; padding: 25px; border: 1px solid #edf1f7; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 450px;">
                    <h4 style="color: #002147; font-size: 1.1rem; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
                        <i class="fas fa-user-circle" style="color: #9E2A2B; font-size: 1.3rem;"></i> ${name.trim()}
                    </h4>
                    <div>${formattedLines}</div>
                </div>`;
            })

            // Fallback for isolated contact lines not inside a group
            .replace(/<p>(?:&nbsp;|\s)*<img([^>]+)>(?:&nbsp;|\s)*([^<]+)<\/p>/gi, (match, imgAttrs, text) => {
                // If it looks like a contact info but wasn't caught by the above groups
                if (text.length > 0 && text.length < 100 && (text.includes('@') || text.match(/\d{5}/))) {
                    return `<div class="d-flex align-items-center mb-2 premium-contact mt-3" style="gap: 15px; padding: 12px 20px; background: #ffffff; border-radius: 10px; border: 1px solid #edf1f7; box-shadow: 0 2px 10px rgba(0,0,0,0.02); max-width: 450px;"><img${imgAttrs} style="width: 22px; height: 22px; object-fit: contain; flex-shrink: 0; border-radius: 50%;" /> <span style="font-size: 14.5px; color: #444; font-weight: 500; letter-spacing: 0.3px;">${text.trim()}</span></div>`;
                }
                return match;
            })
            
            // Transform user-colored Contact blocks (span with background color #a8252b or rgb(168,37,43))
            .replace(/(?:<p[^>]*>\s*(?:<strong[^>]*>)?\s*<span[^>]*style=["'][^"']*(?:#a8252b|#9d302b|rgb\(\s*168\s*,\s*37\s*,\s*43\s*\)|rgb\(\s*157\s*,\s*48\s*,\s*43\s*\))[^"']*["'][^>]*>[\s\S]*?<\/span>\s*(?:<\/strong>)?\s*<\/p>\s*)+/gi, (match) => {
                let name = "Contact Details";
                let lines = "";
                
                const pRegex = /<p[^>]*>([\s\S]*?)<\/p>/gi;
                let pMatch;
                let isFirst = true;
                let hasLines = false;
                
                while ((pMatch = pRegex.exec(match)) !== null) {
                    let textHtml = pMatch[1];
                    let imgHtml = "";
                    textHtml = textHtml.replace(/<img([^>]+)>/gi, (m, attrs) => {
                        imgHtml = `<img${attrs} style="width: 20px; height: 20px; object-fit: contain; flex-shrink: 0; border-radius: 50%;" />`;
                        return "";
                    });
                    
                    let cleanText = textHtml.replace(/<\/?(?:span|strong|b|em|i)[^>]*>/gi, '').trim();
                    cleanText = cleanText.replace(/&nbsp;/g, ' ').trim();
                    
                    if (isFirst && cleanText.toLowerCase().includes('contact details')) {
                        isFirst = false;
                        continue;
                    }
                    if (isFirst) {
                        name = cleanText;
                        isFirst = false;
                        continue;
                    }
                    
                    if (cleanText === '') continue;
                    
                    if (!imgHtml && cleanText.length < 50 && !cleanText.includes('@') && !cleanText.match(/\d{5}/)) {
                        name = cleanText;
                    } else {
                        hasLines = true;
                        lines += `<div class="d-flex align-items-center mb-2" style="gap: 12px;">${imgHtml} <span style="font-size: 14.5px; color: #444; word-break: break-word; font-weight: 500;">${cleanText}</span></div>`;
                    }
                }
                
                if (!hasLines) return match;
                
                return `<div class="contact-person-card mb-4 mt-4" style="background: #ffffff; border-radius: 12px; padding: 25px; border: 1px solid #edf1f7; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 450px;">
                    <h4 style="color: #002147; font-size: 1.1rem; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
                        <i class="fas fa-user-circle" style="color: #9E2A2B; font-size: 1.3rem;"></i> ${name}
                    </h4>
                    <div>${lines}</div>
                </div>`;
            })

            // Transform Faculty Lines (plain text paragraphs starting with DR. / PROF. etc)
            .replace(/(?:<p[^>]*>\s*(?:<span[^>]*>)?\s*(?:<strong[^>]*>)?\s*(?:<a[^>]*>)?\s*(?:DR\.|PROF\.|MR\.|MRS\.|MS\.)\s+[^<]+(?:<\/a>)?\s*(?:<\/strong>)?\s*(?:<\/span>)?\s*<\/p>\s*){2,}/gi, (match) => {
                let panels = "";
                const pRegex = /<p[^>]*>([\s\S]*?)<\/p>/gi;
                let pMatch;
                while ((pMatch = pRegex.exec(match)) !== null) {
                    let cleanText = pMatch[1].replace(/<\/?(?:span|a|strong|b|em|i)[^>]*>/gi, '').replace(/&nbsp;/g, ' ').trim();
                    if (!cleanText) continue;
                    
                    const parts = cleanText.split(/(?=\s+(?:PRINCIPAL SCIENTIST|RESEARCH SCIENTIST|JUNIOR RESEARCH SCIENTIST|SENIOR RESEARCH SCIENTIST|PROFESSOR|ASSISTANT PROFESSOR|ASSOCIATE PROFESSOR|SCIENTIST|CLINICAL RESEARCHER|INSTRUCTOR|DIRECTOR|DEAN))/i);
                    let name = cleanText;
                    let role = "Faculty / Researcher";
                    if (parts.length > 1) {
                        name = parts[0].trim();
                        role = parts.slice(1).join('').trim();
                    } else {
                        const words = cleanText.split(' ');
                        if (words.length > 3) {
                            name = words.slice(0, words.length - 2).join(' ');
                            role = words.slice(words.length - 2).join(' ');
                        }
                    }
                    
                    panels += `
                    <div class="faculty-panel" style="flex: 0 1 calc(50% - 6px); min-width: 250px;">
                        <div class="faculty-panel-icon"><i class="fas fa-user-tie"></i></div>
                        <div class="faculty-panel-info">
                            <span class="faculty-panel-name">${name}</span>
                            <span class="faculty-panel-role">${role}</span>
                        </div>
                    </div>`;
                }
                return `<div class="faculty-panels" style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 12px; margin-bottom: 30px;">${panels}</div>`;
            })
            
            // Transform Standalone Bold Title + List into an Accordion
            .replace(/<p>(?:&nbsp;|\s)*<strong>([^<]+)<\/strong>(?:&nbsp;|\s)*<\/p>\s*(<(?:ul|ol)[\s\S]*?<\/(?:ul|ol)>)/gi, (match, title, listContent) => {
                return `<details class="cms-accordion"><summary class="cms-accordion-header">${title.trim()}</summary><div class="cms-accordion-body">${listContent}</div></details>`;
            });

        return cleanedContent;
    } catch (err) {
        console.error("Failed to clean content:", err);
        return rawContent; // Fallback to raw if parsing fails
    }
};
