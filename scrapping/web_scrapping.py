from bs4 import BeautifulSoup
import requests

url = "https://www.newegg.ca/cooler-master-v750-sfx-gold-mpy-7501-sfhagv-us-750w/p/N82E16817171171"

result = requests.get(url)
doc = BeautifulSoup(result.text, "html.parser")



prices = doc.find_all(text = "$")

parent = prices[0].parent

strong  = parent.find("strong")
print(strong.text)

# print(parent)
