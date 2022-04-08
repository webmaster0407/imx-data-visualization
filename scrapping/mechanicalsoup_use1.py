import time
import mechanicalsoup

browser = mechanicalsoup.Browser()

for i in range(4):
	page = browser.get("http://olympus.realpython.org/dice")
	tag = page.soup.select('#result')[0]
	result = tag.text
	print(f"The result of your dice roll is : {result}")
	if i < 3:
		time.sleep(10)