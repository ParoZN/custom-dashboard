<?php

namespace App\Traits;

trait WithTable
{
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $filters = [];
    public $search = '';
    public $perPage = 10;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters', 'search');
        $this->resetPage();
    }

    protected function applySearchFilter($query)
    {
        if ($this->search && method_exists($this, 'searchableFields')) {
            $fields = $this->searchableFields();
            $query->where(function ($query) use ($fields) {
                foreach ($fields as $field) {
                    $query->orWhere($field, 'like', '%' . $this->search . '%');
                }
            });
        }
        return $query;
    }

    protected function applyColumnFilters($query)
    {
        if (!empty($this->filters)) {
            foreach ($this->filters as $field => $value) {
                if ($value) {
                    if (is_array($value)) {
                        $query->whereIn($field, $value);
                    } else {
                        $query->where($field, $value);
                    }
                }
            }
        }
        return $query;
    }

    protected function getTableQuery()
    {
        $query = $this->baseQuery();
        $query = $this->applySearchFilter($query);
        $query = $this->applyColumnFilters($query);
        return $query->orderBy($this->sortField, $this->sortDirection);
    }

    abstract protected function baseQuery();
}
