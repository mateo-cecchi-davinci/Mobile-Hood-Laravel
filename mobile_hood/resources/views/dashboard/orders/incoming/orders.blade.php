@extends('dashboard.layout.dashboard')
@section('content')
    @livewire('orders', ['business' => $business])
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ $maps }}&libraries=directions&callback=initMap&libraries=marker"
        async defer></script>
    <script src="/js/dashboard/userLocation.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let id = @json($business->id);

            window.Echo.private(`business.${id}`)
                .listen('IncomingOrder', (e) => {
                    Livewire.emit('orderReceived');
                });
        });
    </script>
@endsection
