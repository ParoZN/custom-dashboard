<div>
    @if (session()->has('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-900 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg">
        <x-table.table 
            :columns="$columns"
            :rows="$products"
            :actions="$actions"
            :filters="$filters"
            :sort-column="$sortField"
            :sort-direction="$sortDirection"
            :create-route="$createRoute"
            :create-text="$createText"
        />
    </div>
</div>
