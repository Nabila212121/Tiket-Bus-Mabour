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
    </div>
    
    <div class="w-100vw mx-8 my-8">
    @livewire('users.tiket.order', ['bus' => $bus, 'date' => $date, 'schedule' => $schedule])
    </div>



    <x-footer></x-footer>


</x-layouts.app>