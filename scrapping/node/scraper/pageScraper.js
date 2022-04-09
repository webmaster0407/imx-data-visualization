const fs = require('fs');
const scraperObject = {
  async scraper(browser, folderName, url) {
    let page = await browser.newPage();
    await page.setViewport({ width: 1366, height: 768 });
    console.log(`Navigating to ${url}...`);
    await page.goto(url, { waitUntil: 'load', timeout: 0 });
    const cdp = await page.target().createCDPSession();
    const { data } = await cdp.send('Page.captureSnapshot', { format: 'mhtml' });
    fs.writeFileSync(`${folderName}/page.mhtml`, data);
    await browser.close();
  }
}

module.exports = scraperObject;