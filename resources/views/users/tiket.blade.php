<x-layouts.app>
    @include('components.navigations.align-right',[
    'active' => 'tiket'
    ])

    <div class="relative isolate overflow-hidden bg-white">
        <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
            <defs>
                <pattern id="0787a7c5-978c-4f66-83c7-11c213f99cb7" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                    <path d="M.5 200V.5H200" fill="none" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#0787a7c5-978c-4f66-83c7-11c213f99cb7)" />
        </svg>
        <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-40">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-8">
                <img class="h-11" src="{{asset('logo.png')}}" alt="Dishub">
                <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Pesan sekarang</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Pengalaman unik untuk menjelajahi keindahan dan kekayaan budaya Kota Madiun dengan kenyamanan bus khusus kami. Temukan pesona kota ini dari sudut-sudut yang berbeda, mulai dari landmark sejarah hingga kuliner lokal yang menggugah selera.</p>
                <br><br>Pengguna dapat melakukan pemesanan maksimal 5 kursi untuk satu hari.
                @livewire('users.tiket.search-form')
            </div>
            <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-0 lg:max-w-none lg:flex-none xl:ml-32">
                <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                    <div class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                        <img src="{{asset('assets/dishub.jpg')}}" alt="App screenshot" width="2432" height="1442" class="w-[76rem] rounded-md shadow-2xl ring-1 ring-gray-900/10">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <x-footer></x-footer>


</x-layouts.app>