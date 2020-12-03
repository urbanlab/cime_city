$( document ).ready(function() {
  let zone = null;
  const charList = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  var lat_offset = 0.007;
  var lng_offset = 0.01;

  // Bouton "imprimer"
  $('#printfinal').on("click", function(e) {
    e.stopPropagation();
    window.print();
  });

  $('#prepare').on("click", function(e) {
    e.stopPropagation();
    $('#popup').show();
    $('#monCode').html($('#code').html());
  });


  $('#close-popup').on("click", function(e) {
    e.stopPropagation();
    $('#popup').hide();
    $('#monCode').html($('#code').html());
  });

  map.on("click", function(e) {
    console.log(e.latlng);
    $("#gps").html("<span><u>Latitude</u> : de "+e.latlng.lat+" à " + e.latlng.lat + lat_offset + "</span>, <span><u>Longitude</u> : de "+e.latlng.lng+" à "+e.latlng.lng + lng_offset+"</span>");
    $("#code").html(randomString(5, charList));
    $('#prepare').show();

    // define rectangle geographical bounds
    var bounds = [[e.latlng.lat, e.latlng.lng], [parseFloat(e.latlng.lat) + lat_offset, parseFloat(e.latlng.lng) + lng_offset]];

    // create an orange rectangle
    if (zone != null) {
      zone.remove();
    }

    zone = L.rectangle(bounds, {color: "#ff7800", weight:2});
    zone.addTo(map);

    // zoom the map to the rectangle bounds
    map.fitBounds(bounds);

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
