const axios = require('axios');
const cheerio = require('cheerio');
const fs = require('fs');

const urls = [
  "https://thsti.res.in/en/research-details/18/medica-researc-center",
  "https://thsti.res.in/en/research-details/19/translationa-researc-facility",
  "https://thsti.res.in/en/research-details/20/bi-foundry",
  "https://thsti.res.in/en/research-details/11/biosafet-leve-lab",
  "https://thsti.res.in/en/research-details/12/dat-managemen-centre",
  "https://thsti.res.in/en/research-details/13/mult-omic-facility",
  "https://thsti.res.in/en/research-details/14/experimenta-anima-facility",
  "https://thsti.res.in/en/research-details/15/vaccin-desig-an-developmen-centre",
  "https://thsti.res.in/en/research-details/9/immunolog-cor-laboratory"
];

async function scrapeAll() {
    let sql = 'USE thsti_dev;\nGO\n\n';
    
    for (const url of urls) {
        try {
            const res = await axios.get(url);
            const $ = cheerio.load(res.data);
            
            // The title is usually in a h1 or the breadcrumb
            let title = $('h1').text().trim() || $('h2.title').text().trim() || $('.page-title h1').text().trim();
            if (!title) {
                // fallback to finding it in the breadcrumbs or similar
                title = $('.breadcrumb li.active').text().trim();
            }
            
            // Content
            // We look for a typical content wrapper. Let's try .about-text or similar. 
            // In THSTI theme, it might be `.about-right`, `.content-box`, etc.
            // A good way is to find the element containing the text or paragraph.
            // Let's just grab the whole container for now if we don't know the exact class.
            let contentHtml = $('.about-right').html() || $('.sec-title').parent().html() || $('.project-details-content').html() || $('.single-service-content').html() || $('.about-text-box').html() || $('.inner-container').html() || $('.content-side').html();
            
            if(!contentHtml) {
               // generic fallback for THSTI: look for paragraphs inside a col-md-8 or similar
               const pParent = $('p').first().parent();
               if(pParent.length) {
                   contentHtml = pParent.html();
               } else {
                   contentHtml = '<p>Content not found</p>';
               }
            }

            // Clean up content HTML to remove scripts, styles, buttons, etc.
            const $content = cheerio.load(contentHtml);
            $content('script, style, button, a.theme-btn, .sidebar, .widget').remove();
            let cleanContent = $content.html() || contentHtml;
            cleanContent = cleanContent.replace(/'/g, "''").trim();
            
            // Image
            // Look for the main image in the page. Usually inside an .image-box or the first large img.
            let img = $('.image-box img').attr('src') || $('.about-image img').attr('src') || $('.project-details-image img').attr('src') || $('img').eq(1).attr('src');
            if (img && !img.startsWith('http')) {
                img = 'https://thsti.res.in' + (img.startsWith('/') ? '' : '/') + img;
            }
            
            // Map title to our slug
            let slug = '';
            if (url.includes('medica-researc-center')) slug = 'medical-research-center';
            else if (url.includes('translationa-researc-facility')) slug = 'translational-research-facility';
            else if (url.includes('bi-foundry')) slug = 'bio-foundry';
            else if (url.includes('biosafet-leve-lab')) slug = 'biosafety-level-3-lab';
            else if (url.includes('dat-managemen-centre')) slug = 'data-management-centre';
            else if (url.includes('mult-omic-facility')) slug = 'multi-omics-facility';
            else if (url.includes('experimenta-anima-facility')) slug = 'experimental-animal-facility';
            else if (url.includes('vaccin-desig-an-developmen-centre')) slug = 'vaccine-design-and-development-centre';
            else if (url.includes('immunolog-cor-laboratory')) slug = 'immunology-core-laboratory';
            
            sql += `UPDATE ResearchFacility SET \n`;
            sql += `    Content = '${cleanContent}',\n`;
            sql += `    ImageUrl = '${img}'\n`;
            sql += `WHERE Slug = '${slug}';\nGO\n\n`;
            
            console.log(`Scraped: ${slug}`);
        } catch (err) {
            console.error(`Error fetching ${url}: ${err.message}`);
        }
    }
    
    fs.writeFileSync('c:\\Users\\Roshita\\Documents\\THISTI\\thsti\\server\\update_facilities_content.sql', sql);
    console.log("SQL script written successfully.");
}

scrapeAll();
