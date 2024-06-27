<div>
    @push('styles')
    <style>
        .placeholder {
            background-color: #f3f4f6;
            /* Warna latar belakang untuk placeholder */
            width: 150px;
            /* Lebar placeholder */
            height: 150px;
            /* Tinggi placeholder */
        }
    </style>
    @endpush
    <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 md:max-w-2xl md:grid-cols-2 lg:max-w-4xl xl:mx-0 xl:max-w-none xl:grid-cols-4">
        @foreach ($tickets as $item)
        <div class="rounded-3xl p-4 ring-2 ring-indigo-600">
            <h2 id="tier-startup" class="text-lg text-center font-semibold leading-8 text-indigo-600">
                {{$item->order_id}}
            </h2>
            <div class="flex justify-center">
                <img src="{{$item->qr_image}}" alt="" class="placeholder">
            </div>
            <ul role="list" class="mt-4 space-y-3 text-sm leading-6 text-gray-600">
                <li class="flex">
                   <span class="flex-1 font-bold text-xs">Bus</span>
                   <span class="flex-1 text-xs text-right">{{$item->bus->name}}</span>
                </li>
                <li class="flex">
                    <span class="flex-none font-bold text-xs">Pemesanan</span>
                    <span class="flex-1 text-xs text-right">{{date("l, d F Y", strtotime($item->created_at))}}</span>
                </li>
                <li class="flex">
                    <span class="flex-none font-bold text-xs">Keberangkatan</span>
                    <span class="flex-1 text-xs text-right">{{date("l, d FY", strtotime($item->departure_time))}}</span>
                </li>
            </ul>

            @push('styles')
            <style>
                .status-color-{{$item->id}} {
                    background-color: {{$item->status_color}};
                }
            </style>
            @endpush

            <div class="flex justify-center space-x-2">

                <p aria-describedby="tier-startup" class="
                mt-6 flex-1 rounded-md
                py-2 px-3 text-center
                text-sm font-semibold leading-6
                focus-visible:outline focus-visible:outline-2
                focus-visible:outline-offset-2
                focus-visible:outline-indigo-600
                text-white
                status-color-{{$item->id}}
                shadow-sm hover:bg-indigo-500">
                    {{$item->status_text}}
                </[]>
            </div>


            @if($item->status == 'pending')
            <div class="mt-6 flex justify-center space-x-8">

                <div class="flex-1">
                    {{($this->batalkanTiket)(['id'=>$item->id])}}
                </div>
                <div class="flex-none"></div>
                <div class="flex-1 text-right">
                    {{($this->cetakTiket)(['id' => $item->id])}}
                </div>
            </div>
            @endif

        </div>
        @endforeach

    </div>

    <x-filament-actions::modals />
</div>