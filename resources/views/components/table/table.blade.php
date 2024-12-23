<div class="bg-white shadow rounded-lg {{ $containerClass }}">
    <!-- Table Header with Filters and Actions -->
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex-1 min-w-0 space-y-3">
                <!-- Search Bar -->
                <div class="max-w-lg w-full lg:max-w-xs">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input wire:model.debounce.300ms="applySearchFilter" id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm" placeholder="Search" type="search">
                    </div>
                </div>
                <!-- Filters -->
                @if(!empty($filters))
                    <div class="flex flex-wrap gap-4">
                        @include('components.table.filters')
                    </div>
                @endif
            </div>
            <div class="flex mt-4 md:mt-0 md:ml-4">
                @if($createRoute)
                    <a href="{{ $createRoute }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#4d5bf9] hover:bg-[#4d5bf9]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4d5bf9]">
                        <i class="fas fa-plus mr-2"></i>
                        {{ $createText }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach($columns as $column)
                        <th scope="col" 
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700"
                            wire:click="sortBy('{{ $column['field'] ?? '' }}')"
                        >
                            {{ $column['label'] }}
                            @if(($sortColumn ?? '') === ($column['field'] ?? ''))
                                <span class="ml-1">
                                    @if(($sortDirection ?? 'asc') === 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                </span>
                            @endif
                        </th>
                    @endforeach
                    @if(!empty($actions))
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rows as $row)
                    <tr>
                        @foreach($columns as $column)
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(isset($column['component']))
                                    <x-dynamic-component 
                                        :component="$column['component']"
                                        :row="$row"
                                        :column="$column"
                                    />
                                @else
                                    {!! $row->{$column['field']} ?? '' !!}
                                @endif
                            </td>
                        @endforeach
                        @if(!empty($actions))
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @include('components.table.actions')
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + (!empty($actions) ? 1 : 0) }}" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            No records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($rows, 'links'))
        <div class="px-4 py-3 border-t border-gray-200">
            {{ $rows->links() }}
        </div>
    @endif
</div>
