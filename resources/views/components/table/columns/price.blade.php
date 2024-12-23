@props(['row', 'column'])

<div class="flex items-center">
    <span class="text-sm font-medium text-gray-900">
        € {{ number_format($row->price, 2, ',', '.') }}
    </span>
</div>
