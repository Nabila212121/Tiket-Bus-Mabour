<x-layouts.app>
    @include('components.navigations.align-right',[
    'active' => 'home'
    ])

    <main>
        <div class="relative isolate">
            <svg class="absolute inset-x-0 top-0 -z-10 h-[64rem] w-full stroke-gray-200 [mask-image:radial-gradient(32rem_32rem_at_center,white,transparent)]" aria-hidden="true">
                <defs>
                    <pattern id="1f932ae7-37de-4c0a-a8b0-a6e3b4d44b84" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                        <path d="M.5 200V.5H200" fill="none" />
                    </pattern>
                </defs>
                <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
                    <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0" />
                </svg>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#1f932ae7-37de-4c0a-a8b0-a6e3b4d44b84)" />
            </svg>
            <div class="absolute left-1/2 right-0 top-0 -z-10 -ml-24 transform-gpu overflow-hidden blur-3xl lg:ml-24 xl:ml-48" aria-hidden="true">
                <div class="aspect-[801/1036] w-[50.0625rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(63.1% 29.5%, 100% 17.1%, 76.6% 3%, 48.4% 0%, 44.6% 4.7%, 54.5% 25.3%, 59.8% 49%, 55.2% 57.8%, 44.4% 57.2%, 27.8% 47.9%, 35.1% 81.5%, 0% 97.7%, 39.2% 100%, 35.2% 81.4%, 97.2% 52.8%, 63.1% 29.5%)"></div>
            </div>
            <div class="overflow-hidden">
                <div class="mx-auto max-w-7xl px-6 pb-32 pt-36 sm:pt-60 lg:px-8 lg:pt-32">
                    <div class="mx-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
                        <div class="relative w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">E-Tiket Madiun Bus On Tour</h1>
                            <br>
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Mabour</h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600 sm:max-w-md lg:max-w-none">Dapatkan tiket bus Mabour dengan lebih mudah dan praktis melalui website pemesanan. Sekarang Anda dapat melakukan reservasi kapan saja dan di mana saja dengan hanya beberapa klik. Nikmati kenyamanan memesan tiket bus tanpa harus antri atau berkunjung langsung ke loket. Jangan lewatkan kesempatan untuk merencanakan perjalanan Anda dengan lebih fleksibel dan efisien melalui layanan reservasi online yang disediakan oleh Mabour.</p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <a href="/tiket" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Pesan Sekarang</a>
                                <a href="#pemesanan" class="text-sm font-semibold leading-6 text-gray-900">Cara Pemesanan <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                        <div class="mt-14 flex justify-end gap-8 sm:-mt-44 sm:justify-start sm:pl-20 lg:mt-0 lg:pl-0">
                            <div class="ml-auto w-44 flex-none space-y-8 pt-32 sm:ml-0 sm:pt-80 lg:order-last lg:pt-36 xl:order-none xl:pt-80">
                                <div class="relative">
                                    <img src="https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/cakrawala/2020/07/WhatsApp-Image-2020-07-14-at-20.59.16.jpeg" alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg">
                                    <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                            </div>
                            <div class="mr-auto w-44 flex-none space-y-8 sm:mr-0 sm:pt-52 lg:pt-36">
                                <div class="relative">
                                    <img src="https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2022/08/07/409135664.jpg" alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg">
                                    <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                                <div class="relative">
                                    <img src="https://static.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/p1/192/2024/01/09/f-wisatabus-2446428798.jpg" alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg">
                                    <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                            </div>
                            <div class="w-44 flex-none space-y-8 pt-32 sm:pt-0">
                                <div class="relative">
                                    <img src="https://cdn.idntimes.com/content-images/community/2020/07/img-20200714-180604-1a230235a37f97898f9ffecacb8e1b7c.jpg" alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg">
                                    <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                                <div class="relative">
                                    <img src="https://cdn.antaranews.com/cache/1200x800/2020/07/06/Bus-wisata-madiun.jpg" alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg">
                                    <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto my-32 max-w-7xl sm:mt-40 sm:px-6 lg:px-8">
            <div class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16" style="background-image: url('assets/dishub.png'); background-size: cover; background-position: center bottom;">
                <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">Mabour</h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">Reservasi Tiket Bus Tanpa Batas Waktu, Tanpa Batas Tempat dengan Mabour - Liburan Anda Dimulai dari Sini!</p>
                <div class="absolute -top-24 right-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
                    <div class="aspect-[1404/767] w-[87.75rem] bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-25" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>
                </div>
            </div>
        </div>

        <div class="bg-white py-24 sm:py-32" id="pemesanan">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">CARA PEMESANAN</h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">Cari tahu bagaimana cara pemesanan E-Tiket Bus Mabour</p>
                </div>
                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                        <img src="https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Thumbnail_Circle_to_Search_mDtZ1.width-1000.format-webp.webp" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                Pilih rincian perjalanan
                            </a>
                        </h3>
                        <div class="text-sm leading-6 text-gray-300">
                            <div class="flex items-center gap-x-4">
                                <div class="flex gap-x-2.5">
                                    Masukkan tanggal perjalanan dan kemudian klik 'Cari' untuk melihat jadwal keberangkatan bus Mabour.
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/mobile-flight-booking-6772718-5618934.png?f=webp" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                Pilih bis dan tempat duduk anda
                            </a>
                        </h3>
                        <div class="text-sm leading-6 text-gray-300">
                            <div class="flex items-center gap-x-4">
                                <div class="flex gap-x-2.5">
                                    Pilih kloter dan waktu keberangkatan, tempat duduk lalu klik 'Pesan'
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                        <img src="https://paytmblogcdn.paytm.com/wp-content/uploads/2022/01/3_What-is-a-QR-code-Know-everything-about-it-800x500.jpg" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                Simpan Qr-Code secara Gratis
                            </a>
                        </h3>
                        <div class="text-sm leading-6 text-gray-300">
                            <div class="flex items-center gap-x-4">
                                <div class="flex gap-x-2.5">
                                    Simpan QR-Code untuk Verifikasi ulang keberangkatan. jika kehilangan anda bisa menemukan di menu tiket saya.
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="mx-auto max-w-2xl mt-12 text-center">
                    <a href="/tiket" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Pesan Sekarang</a>

                </div>

            </div>
        </div>
    </main>



    <x-footer></x-footer>


</x-layouts.app>