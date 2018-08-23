# encoding=utf8
import sys
reload(sys)
sys.setdefaultencoding('utf8')

import requests
import json

url = "https://us1.locationiq.com/v1/search.php"

f = open("restLoc.txt", "r")
f1 = open("restCord.txt", "w")
addresses = f.read()
addresses = addresses.split(".esc")
for i in addresses:
    data = {
            'key': '939a229e3db303',
            'q':i,
            'format': 'json'
        }

    response = requests.get(url, params=data)
    parsed = json.loads(response.text)
    f1.write(parsed[0]['lat'] + ",")
    f1.write (parsed[0]['lon'] + ".esc")
    f1.write("\n")

# 939a229e3db303
