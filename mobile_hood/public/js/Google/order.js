let map;
let marker = null;
let lat, lng;

const businessLat = document.getElementById("businessLat").innerHTML;
const businessLng = document.getElementById("businessLng").innerHTML;
const mapElement = document.getElementById("map");

const userMarker = document.createElement("img");
userMarker.src = "/img/markers/r/user_marker.png";

const businessMarker = document.createElement("img");
businessMarker.src = "/img/markers/r/store_marker.png";

function initMap() {
    var mapOptions = {
        center: new google.maps.LatLng(-34.6156548, -58.5156988),
        zoom: 5,
        zoomControl: false,
        streetViewControl: false,
        mapId: "49efa54119f3fb2a",
        gestureHandling: "cooperative",
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    lat = -34.606812;
    lng = -58.484918;

    var origin = new google.maps.LatLng(lat, lng);
    map.setCenter(origin);
    addUserMarker(origin);

    var destination = new google.maps.LatLng(businessLat, businessLng);

    addBusinessMarker(destination);

    const directionsService = new google.maps.DirectionsService();

    calculateAndDisplayRoute(origin, destination);

    function calculateAndDisplayRoute(origin, destination) {
        directionsService.route(
            {
                origin: origin,
                destination: destination,
                travelMode: "DRIVING",
            },
            (response, status) => {
                if (status === "OK") {
                    var rendererOptions = {
                        suppressMarkers: true,
                        polylineOptions: {
                            strokeColor: "#ffba3b",
                            strokeWeight: "8",
                        },
                    };
                    const directionsRenderer =
                        new google.maps.DirectionsRenderer(rendererOptions);
                    directionsRenderer.setMap(map);
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert("Directions request failed due to " + status);
                }
            },
        );
    }
}

function addUserMarker(location) {
    marker = new google.maps.marker.AdvancedMarkerElement({
        map: map,
        position: location,
        gmpDraggable: false,
        content: userMarker,
    });
}

function addBusinessMarker(location) {
    marker = new google.maps.marker.AdvancedMarkerElement({
        map: map,
        position: location,
        gmpDraggable: false,
        content: businessMarker,
    });
}

window.onload = initMap;
