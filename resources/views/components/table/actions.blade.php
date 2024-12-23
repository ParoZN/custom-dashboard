@foreach($actions as $action)
    @if(isset($action['condition']) && !$action['condition']($row))
        @continue
    @endif

    @switch($action['type'] ?? 'link')
        @case('link')
            <a href="{{ $action['url']($row) }}" 
               class="text-{{ $action['color'] ?? 'indigo' }}-600 hover:text-{{ $action['color'] ?? 'indigo' }}-900 {{ !$loop->first ? 'ml-2' : '' }}"
               @if(isset($action['target'])) target="{{ $action['target'] }}" @endif
               @if(isset($action['title'])) title="{{ $action['title'] }}" @endif>
                @if(isset($action['icon']))
                    <i class="{{ $action['icon'] }} {{ isset($action['label']) ? 'mr-1' : '' }}"></i>
                @endif
                {{ $action['label'] ?? '' }}
            </a>
            @break

        @case('button')
            <button wire:click="{{ $action['action'] }}({{ $row->id }})"
                    class="text-{{ $action['color'] ?? 'indigo' }}-600 hover:text-{{ $action['color'] ?? 'indigo' }}-900 {{ !$loop->first ? 'ml-2' : '' }}"
                    @if(isset($action['confirm']))
                        onclick="return confirm('{{ $action['confirm'] }}')"
                    @endif>
                @if(isset($action['icon']))
                    <i class="{{ $action['icon'] }} {{ isset($action['label']) ? 'mr-1' : '' }}"></i>
                @endif
                {{ $action['label'] ?? '' }}
            </button>
            @break

        @case('dropdown')
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="text-{{ $action['color'] ?? 'gray' }}-600 hover:text-{{ $action['color'] ?? 'gray' }}-900 {{ !$loop->first ? 'ml-2' : '' }}">
                    @if(isset($action['icon']))
                        <i class="{{ $action['icon'] }}"></i>
                    @endif
                    {{ $action['label'] ?? '' }}
                </button>

                <div x-show="open"
                     @click.away="open = false"
                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                    <div class="py-1">
                        @foreach($action['items'] as $item)
                            @if(isset($item['condition']) && !$item['condition']($row))
                                @continue
                            @endif
                            
                            @if($item['type'] === 'button')
                                <button wire:click="{{ $item['action'] }}({{ $row->id }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        @if(isset($item['confirm']))
                                            onclick="return confirm('{{ $item['confirm'] }}')"
                                        @endif>
                                    @if(isset($item['icon']))
                                        <i class="{{ $item['icon'] }} mr-2"></i>
                                    @endif
                                    {{ $item['label'] }}
                                </button>
                            @else
                                <a href="{{ $item['url']($row) }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    @if(isset($item['icon']))
                                        <i class="{{ $item['icon'] }} mr-2"></i>
                                    @endif
                                    {{ $item['label'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @break
    @endswitch
@endforeach
