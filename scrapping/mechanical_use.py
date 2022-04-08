import mechanicalsoup

#1
browser = mechanicalsoup.Browser()
url = "http://localhost:8006/auth/login"
login_page = browser.get(url)
login_html = login_page.soup

#2
form = login_html.select("form")[0]
form.select('input')[1]['value'] = "vladis2022"
form.select('input')[2]['value'] = "1(S%h3%Hf613#}D"

# print(form.select('input')[1])
# print(form.select('input')[2])

dashboard_page = browser.submit(form, login_page.url)

links = dashboard_page.soup.select('a')

for link in links:
	address = link['href']
	text = link.text
	print(f"{text} : {address}")