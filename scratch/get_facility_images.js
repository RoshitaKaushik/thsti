const axios = require('axios');
const cheerio = require('cheerio');
const fs = require('fs');

async function scrapeImages() {
    const res = await axios.get('https://thsti.res.in/en/research_facilities');
    const $ = cheerio.load(res.data);
    const facilities = [];

    // On THSTI site, listings might be in .project-block, .service-block, .news-block, etc.
    // Let's grab all images inside the main container and their corresponding headings
    $('.container a').each((i, el) => {
        const href = $(el).attr('href');
        if (href && (href.includes('research-details') || href.toLowerCase().includes('facility') || href.toLowerCase().includes('centre'))) {
            // Usually the image is inside this a tag or its parent
            const imgEl = $(el).find('img').length ? $(el).find('img') : $(el).closest('.inner-box, .project-block, .news-block, .lower-content').parent().find('img');
            let img = imgEl.attr('src');
            const text = $(el).text().trim() || imgEl.attr('alt');
            
            if (img && !img.startsWith('http')) {
                img = 'https://thsti.res.in' + (img.startsWith('/') ? '' : '/') + img;
            }
            if (img && href) {
                facilities.push({ text, href, img });
            }
        }
    });

    console.log(JSON.stringify(facilities, null, 2));
}

scrapeImages();
