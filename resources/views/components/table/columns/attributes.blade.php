@props(['row', 'column'])

<div class="flex flex-col gap-1">
    @foreach($row->attributes as $attribute)
        <div class="text-sm">
            <span class="font-medium text-gray-700">{{ $attribute->name }}:</span>
            <span class="text-gray-600">{{ $attribute->pivot->value }}</span>
        </div>
    @endforeach
</div> 