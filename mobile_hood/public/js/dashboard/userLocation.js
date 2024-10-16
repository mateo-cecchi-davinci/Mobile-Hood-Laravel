let map;

const businessLat = document.getElementById("businessLat").innerHTML;
const businessLng = document.getElementById("businessLng").innerHTML;

function initMap() {
    const mapElements = document.querySelectorAll("#map");

    mapElements.forEach((mapElement) => {
        var mapOptions = {
            center: new google.maps.LatLng(-34.6156548, -58.5156988),
            zoom: 5,
            zoomControl: false,
            streetViewControl: false,
            mapId: "49efa54119f3fb2a",
            gestureHandling: "cooperative",
            fullscreenControl: false,
        };

        const map = new google.maps.Map(mapElement, mapOptions);

        const origin = new google.maps.LatLng(-34.606812, -58.484918);
        map.setCenter(origin);
        addUserMarker(map, origin);

        var destination = new google.maps.LatLng(businessLat, businessLng);
        addBusinessMarker(map, destination);

        const directionsService = new google.maps.DirectionsService();
        calculateAndDisplayRoute(map, directionsService, origin, destination);
    });
}

function calculateAndDisplayRoute(map, directionsService, origin, destination) {
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
                const directionsRenderer = new google.maps.DirectionsRenderer(
                    rendererOptions,
                );
                directionsRenderer.setMap(map);
                directionsRenderer.setDirections(response);
            } else {
                window.alert("Directions request failed due to " + status);
            }
        },
    );
}

function addUserMarker(map, location) {
    const userMarker = document.createElement("img");
    userMarker.src = "/img/markers/r/user_marker.png";

    const marker = new google.maps.marker.AdvancedMarkerElement({
        map: map,
        position: location,
        gmpDraggable: false,
        content: userMarker,
    });
}

function addBusinessMarker(map, location) {
    const businessMarker = document.createElement("img");
    businessMarker.src = "/img/markers/r/store_marker.png";

    const marker = new google.maps.marker.AdvancedMarkerElement({
        map: map,
        position: location,
        gmpDraggable: false,
        content: businessMarker,
    });
}

document.addEventListener("livewire:load", function () {
    initMap();

    Livewire.hook("message.processed", () => {
        initMap();
    });
});

window.onload = initMap;
