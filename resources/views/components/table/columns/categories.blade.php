@props(['row', 'column'])

<div class="flex flex-wrap gap-1">
    @foreach($row->categories as $category)
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            {{ $category->name }}
        </span>
    @endforeach
</div> 