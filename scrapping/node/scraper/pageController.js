const pageScraper = require('./pageScraper');
async function scrapeAll(browserInstance, folderName, url){
	let browser;
	try{
		browser = await browserInstance;
		await pageScraper.scraper(browser, folderName, url);	
	}
	catch(err){
		console.log("Could not resolve the browser instance => ", err);
	}
}

module.exports = (browserInstance, folderName, url) => scrapeAll(browserInstance, folderName, url)