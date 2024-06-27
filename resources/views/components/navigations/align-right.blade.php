<!-- <header class="bg-white fixed top-0 w-full z-50" x-data="{  isOpen : false  }"> -->
<header class="bg-white" x-data="{  isOpen : false  }">
    <nav class="mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto" src="{{asset('logo.png')}}" alt="">
            </a>
        </div>
        <!-- Mobile menu button -->
        <div class="flex lg:hidden">
            <button type="button" @click="isOpen = !isOpen" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12 items-center">
            <a href="/" class="{{$active == 'home'? 'bg-gray-900 p-3 rounded-full text-white':'text-gray-900'}} text-sm font-semibold leading-6">Home</a>
            <a href="/tiket" class="{{$active == 'tiket'? 'bg-gray-900 p-3 rounded-full text-white':'text-gray-900'}} text-sm font-semibold leading-6">Tiket</a>
            <!-- <a href="/rute" class="{{$active == 'rute'? 'bg-gray-900 p-3 rounded-full text-white':'text-gray-900'}} text-sm font-semibold leading-6">Rute</a> -->

            @auth
            <!-- Profile dropdown -->
            <div class="relative ml-3" x-data="{  isProfileOpen : false  }">
                <div>
                    <button type="button" class="relative  flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true" @click="isProfileOpen = !isProfileOpen">
                        <div class="flex items-center space-x-2">
                            <div class="text-sm font-semibold text-white text-center px-6 inline-block align-middle">{{auth()->user()->name}}</div>
                            <img class="h-10 w-10 rounded-full" src="{{auth()->user()->photo_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" alt="">
                        </div>
                    </button>
                </div>

                <div class="hidden" :class="{ 'hidden': ! isProfileOpen }" x-show.important="isProfileOpen" x-transition @click.away="isProfileOpen = false">
                    <div class="absolute right-0 z-[1000] mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <!-- <a href="/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</a>
                        <a href="/my-tiket" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Tiket Saya</a>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-sm text-gray-700">Keluar</button>
                        </form> -->
                        @livewire('profile-menu')
                    </div>
                </div>

            </div>


            @else
            <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
            @endauth
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true" x-show="isOpen" @click.away="isOpen = false">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-[1000]"></div>
        <div class="fixed inset-y-0 right-0 z-[1000] w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                @auth
                <button type="button" class="relative  flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <div class="flex items-center space-x-2">
                        <div class="text-sm font-semibold text-white text-center px-6 inline-block align-middle">{{auth()->user()->name}}</div>
                        <img class="h-10 w-10 rounded-full" src="{{auth()->user()->photo_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}}" alt="">
                    </div>
                </button>
                @endauth
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="isOpen = !isOpen">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6 mx-3">
                        <a href="/" class="-mx-3 block rounded-lg px-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                        <a href="/tiket" class="-mx-3 block rounded-lg px-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Tiket</a>
                        <!-- <a href="/rute" class="-mx-3 block rounded-lg px-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Rute</a> -->
                    </div>
                    @auth
                    <div class="space-y-2 py-6">
                        @livewire('profile-menu')
                    </div>
                    @else

                    <div class="py-6">
                        <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>