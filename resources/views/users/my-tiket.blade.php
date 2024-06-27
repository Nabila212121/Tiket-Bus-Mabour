<x-layouts.app>
    @include('components.navigations.align-right',[
    'active' => null
    ])

    <main>
        <!-- Pricing section -->
        <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Tiket Saya</p>
            </div>
            <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">Beberapa tiket yang sudah kamu reservasi.</p>
            @livewire('users.my-tiket.list-tiket', ['tickets' => $tickets->items()])

            <div class="mt-32">
                {{ $tickets->links() }}
            </div>
        </div>


        <br><br><br><br>


    </main>


    <x-footer></x-footer>


</x-layouts.app>