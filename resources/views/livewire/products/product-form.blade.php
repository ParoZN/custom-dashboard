<div>
    @php
        logger()->info('Rendering product form view', [
            'fields' => $fields,
            'has_success' => session()->has('success'),
            'has_error' => session()->has('error'),
        ]);
    @endphp

    @if (session()->has('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-900 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 px-4 py-2 bg-red-100 text-red-900 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="save" class="max-w-2xl mx-auto">
        @csrf
        @foreach ($fields as $field)
            <x-form.field :field="$field" />
        @endforeach

        <div class="flex justify-end space-x-3 pt-5 border-t">
            <button type="button" wire:click="cancel"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </button>
            <button wire:loading.attr="disabled"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#4d5bf9] hover:bg-[#4d5bf9]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4d5bf9]">
                Save
            </button>
        </div>
    </form>

    @if ($errors->any())
        <div class="mt-4">
            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized for product form');
        });

        // Debug form submission
        document.querySelector('form').addEventListener('submit', (e) => {
            console.log('Form submit event triggered');
            // Don't prevent default here, let Livewire handle it
        });
    </script>
</div>
