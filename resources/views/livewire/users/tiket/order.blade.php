<div>
    <form wire:submit="create">
        {{ $this->form }} {{--menampilkan formulir yang telah dibuat sebelumnya di komponen Livewire--}}
    </form> 
    <x-filament-actions::modals />
</div>