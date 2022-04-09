const axios = require('axios');
const cheerio = require('cheerio');
const fs = require('fs');
const browserObject = require('./browser');
const scraperController = require('./pageController');

const getPostTitles = async (baseUrl, start, end) => {
  try {
    // const baseUrl = 'https://uk.farnell.com/c/semiconductors-ics/power-management-ics-pmic/drivers-controllers/ballast-controllers';
    // const page = 1;
    const sublinks = [];
    for (let i = Number(start); i < Number(end) + 1; i++) {
      const { data } = await axios.get(
        `${baseUrl}/prl/results/${i}`
        // 'https://uk.farnell.com/c/semiconductors-ics/power-management-ics-pmic/ac-dc-converters/prl/results/1'
      );
      const $ = cheerio.load(data);
      $('td.productImage > a').each((_idx, el) => {
        const url = $(el).attr().href;
        const title = $(el).attr().title;
        sublinks.push({ url: url, title: title });
      });
    }
    console.log(sublinks.length);
    return sublinks;
  } catch (error) {
    throw error;
  }
};

const startScrap = (baseUrl, start, end, index) => {
  getPostTitles(baseUrl, start, end)
    .then(async (sublinks) => {
      let i = 0;
      async function scrape() {
        try {
          let folderName = `download/${i+Number(index)}.${sublinks[i].title.replaceAll('/', '-')}`;
          if (!fs.existsSync(folderName)) {
            fs.mkdirSync(folderName);
          }
          // create html
          const browserInstance = browserObject.startBrowser();
          scraperController(browserInstance, folderName, sublinks[i].url);
          // await (await browserInstance).close();
          const { data } = await axios.get(
            sublinks[i].url
          );
          const $ = cheerio.load(data);

          $('div > dd > a').each(async (_idx, el) => {
            const downloadLink = $(el).attr().href;
            if (downloadLink.slice(-4) === '.pdf') {
              try {
                //datasheet download
                const name = `${folderName}/datasheet.pdf`;
                let file = fs.createWriteStream(name);
                const response = await axios({
                  url: downloadLink,
                  method: 'GET',
                  responseType: 'stream'
                });
                response.data.pipe(file);
              } catch (err) {
                // console.log(err);
              }
            }
          });
        } catch (err) {
          console.log(err)
        }
        if (i >= sublinks.length) return;
        setTimeout(scrape, 10000);
        i++;
      }
      scrape();
    });
}

module.exports = startScrap;