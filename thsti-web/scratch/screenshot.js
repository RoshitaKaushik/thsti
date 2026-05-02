const puppeteer = require('puppeteer');
(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.goto('http://localhost:5173/research-centers/maternal-and-child-health', { waitUntil: 'networkidle0' });
  await page.screenshot({ path: 'scratch/screenshot.png', fullPage: true });
  await browser.close();
  console.log('Screenshot saved to scratch/screenshot.png');
})();
