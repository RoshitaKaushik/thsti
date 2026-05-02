const axios = require('axios');
const cheerio = require('cheerio');

axios.get('https://thsti.res.in/en/research-details/18/medica-researc-center').then(r => {
    const $ = cheerio.load(r.data);
    const images = [];
    $('img').each((i, el) => {
        images.push($(el).attr('src'));
    });
    console.log(images.join('\n'));
});
