let map;
let marker = null;
let lat, lng;

function initMap() {
    // Opciones por defecto del mapa
    var mapOptions = {
        center: new google.maps.LatLng(-34.6156548, -58.5156988),
        zoom: 13,
        streetViewControl: false,
        mapId: "faa0d0cbc1a1ec6",
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    if (
        document.getElementById("lat").value == "" &&
        document.getElementById("lng").value == ""
    ) {
        // Obtener la ubicación del usuario
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;

                    var userLocation = new google.maps.LatLng(lat, lng);
                    map.setCenter(userLocation);
                    addMarker(userLocation);

                    // Actualizar datos del formulario
                    document.getElementById("lat").value = lat;
                    document.getElementById("lng").value = lng;
                },
                () => handleLocationError(true, map.getCenter()),
            );
        } else {
            // El navegador no soporta la geolocalización
            handleLocationError(true, map.getCenter());
        }
    } else {
        if (
            document.getElementById("lat").value &&
            document.getElementById("lng").value
        ) {
            lat = document.getElementById("lat").value;
            lng = document.getElementById("lng").value;

            var location = new google.maps.LatLng(lat, lng);
            map.setCenter(location);
            addMarker(location);
        } else {
            lat = document.getElementById("lat").innerText;
            lng = document.getElementById("lng").innerText;

            var location = new google.maps.LatLng(lat, lng);
            map.setCenter(location);
            addMarker(location);
        }
    }

    // Agregar marcador en el click del mapa
    map.addListener("click", function (event) {
        lat = event.latLng.lat();
        lng = event.latLng.lng();
        addMarker(event.latLng);

        // Actualizar datos del formulario
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lng;
    });
}

function addMarker(location) {
    if (marker) {
        // Actualizar la posición del marcador existente
        marker.position = location;
    } else {
        // Crear un nuevo marcador usando AdvancedMarkerElement
        marker = new google.maps.marker.AdvancedMarkerElement({
            map: map,
            position: location,
            gmpDraggable: true,
        });
    }
}

function handleLocationError(browserHasGeolocation, pos) {
    console.log(
        browserHasGeolocation
            ? "Error: El servicio de geolocalización falló."
            : "Error: Tu navegador no soporta geolocalización.",
    );
}

window.onload = initMap;
