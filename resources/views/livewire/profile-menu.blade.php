<div>
    <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">
        {{$this->profile}}
    </div>
    <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="0" id="user-menu-item-1">
        {{$this->myTicket}}
    </div>
    <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="1" id="user-menu-item-2">
        {{$this->logout}}
    </div>

    <x-filament-actions::modals />
</div>