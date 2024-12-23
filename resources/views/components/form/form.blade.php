@props(['submit'])

<form wire:submit.prevent="{{ $submit }}" {{ $attributes }}>
    <div class="space-y-6">
        {{ $slot }}

        <div class="flex justify-end space-x-3 pt-5 border-t">
            @if(isset($buttons))
                {{ $buttons }}
            @else
                <button type="button" 
                        wire:click="cancel"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </button>
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#4d5bf9] hover:bg-[#4d5bf9]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4d5bf9]">
                    <span wire:loading.remove wire:target="{{ $submit }}">Save</span>
                    <span wire:loading wire:target="{{ $submit }}">Saving...</span>
                </button>
            @endif
        </div>
    </div>

    @if($errors->any())
        <div class="mt-4 bg-red-50 p-4 rounded-md">
            <ul class="list-disc list-inside text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
