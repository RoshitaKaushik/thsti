const axios = require('axios');
const cheerio = require('cheerio');

async function getLinks() {
    const res = await axios.get('https://thsti.res.in/');
    const $ = cheerio.load(res.data);
    const links = new Set();
    $('a').each((i, el) => {
        let href = $(el).attr('href');
        if (href && href.includes('research-details')) {
            if (!href.startsWith('http')) {
                href = 'https://thsti.res.in' + href;
            }
            links.add(href);
        }
    });
    console.log(JSON.stringify(Array.from(links), null, 2));
}

getLinks();
