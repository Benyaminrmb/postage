var markers = [];
var markers2 = [];
var map;


var originLongAddress=document.getElementById('originLongAddress');
var originLatAddress=document.getElementById('originLatAddress');
var destinationLongAddress=document.getElementById('destinationLongAddress');
var destinationLatAddress=document.getElementById('destinationLatAddress');

function initMap() {
    var labelIndex = 0;

    function initialize() {
        var center = {lat: originLatAddress.value, lng: originLongAddress.value };
        console.log(center);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: Tehran,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var map2 = new google.maps.Map(document.getElementById('map2'), {
            zoom: 16,
            center: Tehran,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(originLatAddress.value, originLongAddress.value),
            draggable: true
        });

        google.maps.event.addListener(map, 'click', function (event) {
            var lanlat_new = {
                lat: parseFloat(event.latLng.lat().toFixed(3)),
                lng: parseFloat(event.latLng.lng().toFixed(3))
            };
            addMarker(event.latLng, map);


            // originLongAddress.value(lanlat_new.lng);
            // originLatAddress.value(lanlat_new.lat);
        });
        google.maps.event.addListener(map2, 'click', function (event) {
            var lanlat_new = {
                lat: parseFloat(event.latLng.lat().toFixed(3)),
                lng: parseFloat(event.latLng.lng().toFixed(3))
            };
            addMarker2(event.latLng, map2);
            // destinationLongAddress.value(lanlat_new.lng);
            // destinationLatAddress.value(lanlat_new.lat);
        });
        addMarker(Tehran, map);
        addMarker2(Tehran, map2);
    }

    function addMarker2(location, map2) {
        clearMarkers2();
        var marker2 = new google.maps.Marker({
            position: location,
            map: map2,
        });
        markers2.push(marker2);
    }

    function addMarker(location, map) {
        clearMarkers();
        var marker = new google.maps.Marker({
            position: location,
            map: map,
        });
        markers.push(marker);
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
    function setMapOnAll2(map) {
        for (var i = 0; i < markers2.length; i++) {
            markers2[i].setMap(map);
        }
    }

    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    function clearMarkers() {
        setMapOnAll(null);
    }
    function clearMarkers2() {
        setMapOnAll2(null);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}
window.initMap = initMap;
