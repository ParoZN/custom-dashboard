@props(['row', 'column'])

<div class="flex items-center">
    <div class="flex-shrink-0 h-10 w-10">
        <div class="h-10 w-10 rounded-full flex items-center justify-center bg-[#4d5bf9] text-white">
            {{ strtoupper(substr($row->name, 0, 1)) }}
        </div>
    </div>
    <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">
            {{ $row->name }}
        </div>
        <div class="text-sm text-gray-500">
            {{ $row->email }}
        </div>
    </div>
</div>
