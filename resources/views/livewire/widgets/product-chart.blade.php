@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

<div wire:ignore x-data="{ chart: null }" 
     x-init="() => {
        const ctx = $refs.canvas.getContext('2d');
        const chartData = @js($data);
        
        chart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                indexAxis: 'x',
                plugins: {
                    legend: {
                        display: false
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            color: '#f0f0f0'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        Livewire.on('updateChart', newData => {
            chart.data = newData;
            chart.update('active');
        });
     }"
   
    class="w-full h-[400px] bg-white p-8 rounded-lg shadow-sm">
    <canvas x-ref="canvas"></canvas>
</div>
