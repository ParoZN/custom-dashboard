<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class ProductChart extends Component
{
    public $data;

    public function mount()
    {
        $this->data = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'Sales',
                    'backgroundColor' => '#f87979',
                    'borderColor' => '#f87979',
                    'data' => [12, 19, 3, 5, 2, 3, 11],
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
        return view('livewire.widgets.product-chart');
    }
}
