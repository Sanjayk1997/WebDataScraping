# encoding=utf8
import sys
reload(sys)
sys.setdefaultencoding('utf8')

from requests import get



url1 = 'https://www.dineout.co.in/bangalore-restaurants?search_str='
response1 = get(url1)

from bs4 import BeautifulSoup

html_soup = BeautifulSoup(response1.text, 'html.parser')
type(html_soup)

rest_name_container    = html_soup.find_all('div', class_ = 'titleDiv')
rest_location_container = html_soup.find_all('div', class_ ='location')
rest_ratings_container  = html_soup.find_all('div', class_ ='rating rating-5')
rest_url_container     = html_soup.find_all("div", class_ ='right-details cursor')

f = open("restName.txt", "w")
for i in rest_name_container:
    f.write(i.h4.text + ".esc\n")

f = open("restLoc.txt", "w")
for i in rest_location_container:
    f.write(i.text + ".esc\n")

f = open("restRatings.txt", "w")
for i in rest_ratings_container:
    f.write(i.text + ".esc\n")

f = open("restUrl.txt", "w")
for i in rest_url_container:
    f.write("https://www.dineout.co.in" + i["data-url"] + ".esc\n")

x = 0
f1 = open("restReviews.txt", "w")
f = open("restAddress.txt", "w")
for i in rest_url_container:
    url2 = "https://www.dineout.co.in" + i["data-url"]
    response2 = get(url2)
    html_soup1 = BeautifulSoup(response2.text, 'html.parser')
    type(html_soup1)

    rest_review_container = html_soup1.find_all('span', class_ = 'more')[1:]

    x = x + 1
    y = 1
    f1.write(" escape \n")
    for j in rest_review_container:
        f1.write( "esc." + j.text + "\n")
        y = y + 1

    rest_address_container = html_soup1.find('span', class_ = 'address-info')
    f.write(rest_address_container.text + ".esc\n")
