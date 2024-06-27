<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="w-full ">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <div class="grid grid-cols-3 gap-4">
            @foreach($this->bus->seats['all'] as $seat)
            <div>
                <input x-model="state" hidden />
                <label for="{{$seat}}" class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-lg cursor-pointer">
                    <span class="text-xs font-semibold text-gray-900">{{ $seat }}</span>
                </label>
            </div>
            @endforeach
        </div>
    </div>
</x-dynamic-component>