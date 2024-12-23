<!-- Search -->
<div class="flex-1 min-w-0">
    <div class="relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text" 
               wire:model.debounce.300ms="search" 
               class="focus:ring-[#4d5bf9] focus:border-[#4d5bf9] block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
               placeholder="Search...">
    </div>
</div>

<!-- Filters -->
@foreach($filters as $filter)
    <div class="flex-shrink-0">
        @switch($filter['type'] ?? 'select')
            @case('select')
                <select wire:model="filters.{{ $filter['field'] }}"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm rounded-md">
                    <option value="">{{ $filter['placeholder'] ?? 'Select ' . $filter['label'] }}</option>
                    @foreach($filter['options'] as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @break

            @case('date')
                <input type="date" 
                       wire:model="filters.{{ $filter['field'] }}"
                       class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm rounded-md">
                @break

            @case('boolean')
                <select wire:model="filters.{{ $filter['field'] }}"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm rounded-md">
                    <option value="">{{ $filter['placeholder'] ?? 'All' }}</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @break
        @endswitch
    </div>
@endforeach

<!-- Reset Filters -->
@if(!empty($filters) || $search)
    <div class="flex-shrink-0">
        <button wire:click="resetFilters" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4d5bf9]">
            <i class="fas fa-times mr-2"></i>
            Reset
        </button>
    </div>
@endif
