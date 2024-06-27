<div class="pt-10">
    <form wire:submit="create">
        {{ $this->form }}
    </form>

    <div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity {{$showData? '': 'hidden'}}"></div>

        <!-- Slide-over panel -->
        <div class="fixed inset-0 overflow-hidden {{$showData? '': 'hidden'}}">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <!-- Slide-over panel content -->
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-gray-900" id="slide-over-title">Bus Mabour</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" wire:click="closeShowData" class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                <ul role="list" class="flex-1 divide-y divide-gray-200 overflow-y-auto">
                                    @foreach($bus as $item)
                                    <li>
                                        <div class="group relative flex items-center px-5 py-6">
                                            <a href="/tiket/{{base64_encode($item->id.'|'.$date.'|'.$bus_schedule_id)}}" class="-m-1 block flex-1 p-1">
                                                <div class="absolute inset-0 group-hover:bg-gray-50" aria-hidden="true"></div>
                                                <div class="relative flex min-w-0 flex-1 items-center">
                                                    <span class="relative inline-block flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full" src="https://placehold.co/500x500/png?text=Mabour" alt="">
                                                        <!-- Online: "bg-green-400", Offline: "bg-gray-300" -->
                                                    </span>
                                                    <div class="ml-4 truncate">
                                                        <p class="truncate text-sm font-medium text-gray-900">{{$item->name}}</p>
                                                        <span class="relative inline-block flex-shrink-0">
                                                            <span class="text-sm">
                                                                <span class="font-bold">{{sizeof($item->seats['available'])}}</span>
                                                                @if(sizeof($item->seats['available']) > 10)
                                                                <span class="text-green-500">Kursi Tersedia</span>
                                                                @else
                                                                <span class="text-red-500">Kursi Tersisa</span>
                                                                @endif

                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach

                                    <!-- More people... -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>