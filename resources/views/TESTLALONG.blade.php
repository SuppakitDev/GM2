<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script>
var geocoder = new google.maps.Geocoder();
var address = "17/4 Moo.5 Bamroongrat Road Tambon Pibulsongkram Amphur Muang Chiang Rai 51000";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    alert(latitude+" "+longitude);

      } 
}); 

</script>
