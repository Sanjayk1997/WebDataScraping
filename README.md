# datascraping
scraping restaurant details and displaying on a map
System software requirements (Linux):

-Python 2.7.x
-BeautifulSoup library(python) (Scraping tool)
-requests library (python) (for working Url and website responses)
-json library (python) (to parse received data from the online API)
-xammp (to run php)

Steps to run: Make sure all the 3 files are in the same folder, including the css folder

1) run script.py
2) run geocode.py
3) run website.php using localhost in xampp
4) click on different markers to display the corresponding restaurant details & reviews.
(Best to keep the entire folder in the htdocs folder of xammp(lammp in linux))

Functionaities of each component:

1) script.py : this file scrapes the details off the website, creates respective
   files for each name, location, ratings, address, reviews, and writes them
   with the scraped data. If the files are already present, it edits them with
   new information.

2) geocode.py : this file takes the address from the file written by the previous
   code, uses an free online API to convert the address to co-ordinates that can
   be used by maps, and stores them in a file.

3) website.php :the code file containing the backend and partial frontend for the
   website. PHP code reads the data in files, sends them to the Javascript section
   of the website code. The Maps are embedded using  a free map API provided by
   leaflet, a javascript library for interactive maps. The co-ordinates are used
   to place markers, data is used to fill up the popups, and reviews are showed
   on clicking the markers on a table. The CSS folder contains the css file,
   which is used to style the raw frontend elements of the website.

Notes:

-Google Maps werent used because the needed API's for emedding geocoding and maps
 in the website required an API_KEY, which wasn't accessible without setting up a
 payment method on Google cloud platform (wasted too much time trying to get it
 to work). I dont have a personal Mastercard/Visa card and it was too risky to
 set a payment method for an one time use from my parents' card.

-The geocoding API was provided by a free online service by 'locationiq'. The
 accuracy of co-ordinates is questionable, due to it being a free service. It
 returned the same co-ordinates for multiple addresses.

-The Maps are provided by leaflet, a free javascript library the allows the
 embedding of Maps.

-The rest of the concepts which have been used were the concepts in which i had some
 sort of experience and was comfortable with. (PHP,javascript,CSS,Python)
