<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Table extends Component
{
    public $columns;
    public $rows;
    public $actions;
    public $filters;
    public $sortColumn;
    public $sortDirection;
    public $createRoute;
    public $createText;
    public $containerClass;

    public function __construct(
        $columns = [],
        $rows = [],
        $actions = [],
        $filters = [],
        $sortColumn = null,
        $sortDirection = 'asc',
        $createRoute = null,
        $createText = 'Create New',
        $containerClass = ''
    ) {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->actions = $actions;
        $this->filters = $filters;
        $this->sortColumn = $sortColumn;
        $this->sortDirection = $sortDirection;
        $this->createRoute = $createRoute;
        $this->createText = $createText;
        $this->containerClass = $containerClass;
    }

    public function render()
    {
        return view('components.table.table');
    }
}
