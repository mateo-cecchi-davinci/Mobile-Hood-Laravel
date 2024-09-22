const mapElement = document.getElementById("map");

let map;
let marker = null;
let lat, lng;

function initMap() {
    var mapOptions = {
        center: new google.maps.LatLng(-34.6156548, -58.5156988),
        zoom: 13,
        streetViewControl: false,
        mapId: "faa0d0cbc1a1ec6",
        gestureHandling: "cooperative",
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    lat = document.getElementById("lat").innerText;
    lng = document.getElementById("lng").innerText;

    var location = new google.maps.LatLng(lat, lng);
    map.setCenter(location);
    addMarker(location);

    map.addListener("click", function () {
        mapElement.classList.toggle("open");
        menuBtnChange();
    });
}

function addMarker(location) {
    marker = new google.maps.marker.AdvancedMarkerElement({
        map: map,
        position: location,
        gmpDraggable: false,
    });
}

function menuBtnChange() {
    if (mapElement.classList.contains("open")) {
        mapElement.style.height = "31.25rem";
        google.maps.event.trigger(map, "resize");
    } else {
        mapElement.style.height = "7rem";
        google.maps.event.trigger(map, "resize");
    }
}

window.onload = initMap;
