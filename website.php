<?php
$restname = fopen("restName.txt", "r");
$names = fread($restname,filesize("restName.txt"));
$names = (explode(".esc",$names));
fclose($restname);

$restloc = fopen("restLoc.txt", "r");
$location = fread($restloc,filesize("restLoc.txt"));
$location = (explode(".esc",$location));
fclose($restloc);

$ratingsfile = fopen("restRatings.txt", "r");
$ratings = fread($ratingsfile,filesize("restRatings.txt"));
$ratings = (explode(".esc",$ratings));
fclose($ratingsfile);

$resturl = fopen("restUrl.txt", "r");
$url = fread($resturl,filesize("restUrl.txt"));
$url = (explode(".esc",$url));
fclose($resturl);

$restaddr = fopen("restAddress.txt", "r");
$address = fread($restaddr,filesize("restAddress.txt"));
$address = (explode(".esc",$address));
fclose($restaddr);

$restcord = fopen("restCord.txt", "r");
$cord = fread($restcord,filesize("restCord.txt"));
$cord = (explode(".esc",$cord));
fclose($restcord);

$restrev = fopen("restReviews.txt", "r");
$review = fread($restrev,filesize("restReviews.txt"));
$review = (explode("escape",$review));
fclose($restrev);

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"
      integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
      crossorigin=""/>

    <link rel="stylesheet" type="text/css" href="./css/base.css"  />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js">
    </script>

    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"
      integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q=="
      crossorigin=""></script>

    <title></title>
  </head>

  <body>

    <div id = 'head'> Scraped Restaurants' Data from Dineout </div>

    <div style="height: 500px;width: 500px" id="mapid"></div>

    <div id = 'data'></div>

    <script type="text/javascript">


    var mymap = L.map('mapid').setView([12.9716,77.5946], 13);

      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: 'mapbox.streets'
      }).addTo(mymap);

      var coord = <?php echo json_encode($cord) ?>;
      var names = <?php echo json_encode($names) ?>;
      var address = <?php echo json_encode($address) ?>;
      var ratings = <?php echo json_encode($ratings) ?>;
      var url =   <?php echo json_encode($url) ?>;
      var reviews =   <?php echo json_encode($review) ?>


      for(i in coord){
        var latlong = coord[i].split(",");
        var marker = L.marker([latlong[0],latlong[1]]).addTo(mymap);
        marker.bindPopup("<h2>"+names[i]+"&nbsp&nbsp &#9733;"
        +ratings[i]+"</h2>"+"<h4>"+address[i]+"</h4>"
        +"<h4><a href='"+url[i]+"'>Book a Table</a></h4>");
        marker.on('click',onClick);

          }

      function strip_html_tags(str)
            {
               if ((str===null) || (str===''))
                   return false;
              else
               str = str.toString();
              return str.replace(/<[^>]*>/g, '');
            }
      var intro;
      var index;
      function onClick(e) {
        var popup = e.target.getPopup();
        var content = popup.getContent();
        intro = strip_html_tags(content);
        intro = intro.split("&")[0];
        //document.getElementById('data').innerHTML = (intro + "yay")
        for (j in names){
          if (names[j].trim() == intro.trim()){
            index = parseInt(j)+1;
          }
        }

        var rerev = reviews[index].split("esc.");
        rerev.shift();
        var html = "<table>";
        html+= "<thead>";
        html+= "<tr>";
        html+= "<th>Top Anonymous Reviews:</th>";
        html+= "</tr>";
        html+= "</thead>";
        html+= "<tbody>";
        for (k in rerev){
          indice = parseInt(k);
              html+="<tr>";
              html+="<td>"+rerev[indice]+"</td>";
              html+="</tr>";
            }
              html+= "</tbody>";
              html+="</table>";
              document.getElementById("data").innerHTML = html;
        //document.getElementById('data').innerHTML = (reviews[index]);


        }

    </script>

  </body>
</html>
