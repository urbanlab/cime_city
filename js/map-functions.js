$( document ).ready(function() {
    let zone = null;
    const charList = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    map.on("click", function(e) {
      console.log(e.latlng);
      $("#gps").html("<span>Latitude : "+e.latlng.lat+"</span>, <span>Longitude : "+e.latlng.lng+"</span>");
      $("#code").html("<span>Code : " + randomString(5, charList) + "</span>");

      // define rectangle geographical bounds
      var bounds = [[e.latlng.lat, e.latlng.lng], [e.latlng.lat + 0.007 , e.latlng.lng + 0.01]];

      // create an orange rectangle
      if (zone != null) {
        zone.remove();
      }

      zone = L.rectangle(bounds, {color: "#ff7800", weight: 2});
      zone.addTo(map);     

      // zoom the map to the rectangle bounds
      map.fitBounds(bounds);

      // console.log(map.getPixelBounds());
      // console.log(map.getScaleZoom());
      // console.log(map.getZoomScale());
      
      // $.ajax({
      //   type: "GET",
      //   url: "extract.php",
      //   data: "data={lat:"+e.latlng.lat+",lng:"+e.latlng.lng+"}"
      // });
    } );

    function randomString(length, chars) {
      var result = "";
      for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
      return result;
    }

  });