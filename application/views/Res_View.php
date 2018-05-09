<!DOCTYPE html>
<html lang="en">
<head>
  <title>Restaurant Map</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infoWindow;
      var service;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 13.283584, lng: 100.925586},
          zoom: 14,
          styles: [{
            stylers: [{ visibility: 'simplified' }]
          }, {
            elementType: 'labels',
            stylers: [{ visibility: 'off' }]
          }]
        });
        

        infoWindow = new google.maps.InfoWindow();
        service = new google.maps.places.PlacesService(map);

        // The idle event is a debounced event, so we can query & listen without
        // throwing too many requests at the server.
        map.addListener('idle', performSearch);
      }

      function performSearch() {
        var request = {
          bounds: map.getBounds(),
          keyword: 'Restaurant'
        };
        service.radarSearch(request, callback);
      }

      function callback(results, status) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          console.error(status);
          return;
        }
        for (var i = 0, result; result = results[i]; i++) {
          addMarker(result);
        }
      }

      function addMarker(place) {
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          icon: {
            url: 'https://www.freeiconspng.com/uploads/pink-restaurants-icon-19.png',
            anchor: new google.maps.Point(30, 30),
            scaledSize: new google.maps.Size(30, 30)
          }
        });

        google.maps.event.addListener(marker, 'click', function() {
          service.getDetails(place, function(result, status) {
            if (status !== google.maps.places.PlacesServiceStatus.OK) {
              console.error(status);
              return;
            }
            infoWindow.setContent(result.name);
            infoWindow.open(map, marker);
          });
        });
      }
    </script>
    <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
    #map {
      height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 40%;
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body>
 <?php
 $url = 'http://13.229.122.182/API/CommentRes';
 $book_json = file_get_contents($url);
 $book_array = json_decode($book_json, true);
 ?>

 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">ของดีบางแสน</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php base_url();?>/Barry">Home</a></li>
        <li><a href="<?php base_url();?>/Barry/Coppy">Hotel</a></li>
        <li class="active"><a href="<?php base_url();?>/Barry/Restaurant_View">Restaurant</a></li>
        <li><a href="<?php base_url();?>/Barry/Attractions_View">Attractions</a></li>
        <li><a href="<?php base_url();?>/Barry/Recipe2">Recipe</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid"> 
  <div class="row content">
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtnuW7FQshVbrqWiCHNszEDi5F5I4h1eM&callback=initMap&libraries=places,visualization" async defer></script>
  </div>
</div>
<div class="container-fluid"> 
  <div class="row content">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
      <h1>แนะนำร้านอาหารที่บางแสน</h1>
      <?php foreach ($book_array['comment'] as $row) { ?>
      <p><b>Comment : </b><?php echo $row['Com_detail']; ?></p>
      <p><b>Name : <?php echo $row['Com_name']; ?></b></p>
      <hr>
      <?php } ?>
      <form class="w3-container w3-card-4 w3-light-grey" action="<?php base_url();?>/API/addCommentRes" method="post">
        <h2>เขียนแนะนำร้านอาหารที่บางแสน</h2>
        <p><label>Comment</label>
          <input class="w3-input w3-border"  name="comment" type="text"></p>

          <p><label>Name</label>
            <input class="w3-input w3-border" name="name" type="text"></p>
            <p><button class="w3-button w3-white w3-border">Comment</button></p>

          </form>
        </div>
        <div class="col-sm-2">
        </div>
      </div>
    </div>


  </body>
  </html>

