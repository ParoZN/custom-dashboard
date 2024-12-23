<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Today's Sales -->
        <div class="col-span-1 lg:col-span-3 grid grid-cols-1 sm:grid-cols-4 gap-4 bg-white p-6 rounded-lg shadow">
            <div class="bg-[#ffe4e6] rounded-lg p-4">
                <h3 class="text-sm text-gray-600">Total Sales</h3>
                <h2 class="text-2xl font-semibold">$1k</h2>
                <p class="text-sm text-red-500">+5% from yesterday</p>
            </div>
            <div class="bg-[#e9f5ff] rounded-lg p-4">
                <h3 class="text-sm text-gray-600">Total Order</h3>
                <h2 class="text-2xl font-semibold">300</h2>
                <p class="text-sm text-blue-500">+3% from yesterday</p>
            </div>
            <div class="bg-[#e6ffee] rounded-lg p-4">
                <h3 class="text-sm text-gray-600">Product Sold</h3>
                <h2 class="text-2xl font-semibold">5</h2>
                <p class="text-sm text-green-500">+12% from yesterday</p>
            </div>
            <div class="bg-[#f3e8ff] rounded-lg p-4">
                <h3 class="text-sm text-gray-600">New Customers</h3>
                <h2 class="text-2xl font-semibold">8</h2>
                <p class="text-sm text-purple-500">0.5% from yesterday</p>
            </div>
        </div>

        <!-- Visitor Insights -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700">Visitor Insights</h2>
            <div class="mt-4">
                <img src="https://placehold.co/600x300" alt="Graph">
            </div>
        </div>

        <!-- Revenue, Satisfaction, Target vs Reality -->
        <div class="col-span-1 lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Total Revenue</h2>
                <div class="mt-4">
                    <img src="https://placehold.co/600x200" alt="Revenue Graph">
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Customer Satisfaction</h2>
                <div class="mt-4">
                    <img src="https://placehold.co/600x200" alt="Satisfaction Graph">
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Target vs Reality</h2>
                <div class="mt-4">
                    <img src="https://placehold.co/600x200" alt="Target Graph">
                </div>
            </div>
        </div>

        <!-- Additional Charts -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700">Top Products</h2>
            <div class="mt-4">
                <img src="https://placehold.co/600x150" alt="Products">
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700">Sales Mapping by Country</h2>
            <div class="mt-4">
                <img src="https://placehold.co/600x150" alt="Sales Mapping">
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700">Volume vs Service Level</h2>
            <div class="mt-4">
                <img src="https://placehold.co/600x150" alt="Volume Graph">
            </div>
        </div>
    </section>
</x-app-layout>