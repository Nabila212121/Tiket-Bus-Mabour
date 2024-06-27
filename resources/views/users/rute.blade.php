@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<style>
    #map {
        height: 80vh;
    }
</style>

@endpush

<x-layouts.app>
    @include('components.navigations.align-right',[
    'active' => 'rute'
    ])

    <main >
        <div id="map" class="z-[1]"></div>
    </main>



    <x-footer></x-footer>


</x-layouts.app>

<script>
    var map = L.map('map').setView([-7.6289099, 111.52293], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var popup = L.popup()
        .setLatLng([
            -7.623438338842547,
            111.52329032382306
        ])
        .setContent("Titik Awal Pemberangkatan")
        .openOn(map);
    var polyline = L.polyline([
        [
            -7.623438338842547,
            111.52329032382306
        ],
        [
            -7.623618533695222,
            111.52032284974956
        ],
        [
            -7.630478505059784,
            111.5194091923866
        ],
        [
            -7.639085776041227,
            111.51970009421132
        ],
        [
            -7.6395148001342505,
            111.51970616492497
        ],
        [
            -7.639692011621619,
            111.5194636457449
        ],
        [
            -7.639466489730765,
            111.51751752423678
        ],
        [
            -7.630055153376986,
            111.5169006412205
        ],
        [
            -7.631073928398351,
            111.52305158061682
        ],
        [
            -7.630986496894607,
            111.52319378136542
        ],
        [
            -7.627223882792407,
            111.52365561347727
        ],
        [
            -7.62462727641369,
            111.52395783492528
        ],
        [
            -7.6234254164996855,
            111.52407200512033
        ],
        [
            -7.623436868893407,
            111.52330627973521
        ]
    ], {
        color: 'blue'
    }).addTo(map);
</script>