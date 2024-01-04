<style>
    #map { height: 500px;}
</style>
<div id="map"></div>
<script>
    var lokasi = "{{ $presensi->lokasi_in }}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];

    var lokasi_sekolah = "{{$lok_sekolah -> lokasi_sekolah}}";
        var lok = lokasi_sekolah.split(",");
        var lat_sek = lok[0];
        var long_sek = lok[1];

    var map = L.map('map').setView([latitude,longitude], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([latitude,longitude]).addTo(map);
// CIRCLE DISINI
var circle = L.circle([lat_sek, long_sek], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: {{$lok_sekolah -> radius}}
}).addTo(map);

// pop up
var popup = L.popup()
    .setLatLng([latitude, longitude])
    .setContent("{{$presensi -> nama_lengkap }}")
    .openOn(map);
</script>
