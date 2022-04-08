from bs4 import BeautifulSoup
from urllib.request import urlopen

base_url = "http://olympus.realpython.org"
html_page = urlopen(base_url + "/profiles")
html_text = html_page.read().decode("utf-8")

soup = BeautifulSoup(html_text, "html.parser")

for link in soup.find_all("a"):
	link_url = base_url + link['href']
	print(link_url)