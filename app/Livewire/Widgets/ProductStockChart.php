<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductStockChart extends Component
{
    public $data;

    public function mount()
    {
        $topProducts = Product::select('name', 'stock')
            ->orderBy('stock', 'desc')
            ->take(10)
            ->get();

        $this->data = [
            'labels' => $topProducts->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Stock Level',
                    'backgroundColor' => '#4ade80', // Green color
                    'borderColor' => '#4ade80',
                    'data' => $topProducts->pluck('stock')->toArray(),
                    'tension' => 0.4,
                    'fill' => false
                ]
            ]
        ];
    }

    public function updateChartData()
    {
        $this->dispatch('updateChart', data: $this->data);
    }

    public function render()
    {
        return view('livewire.widgets.product-stock-chart');
    }
}
