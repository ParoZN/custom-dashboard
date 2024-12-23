<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithTable;

class UserTable extends Component
{
    use WithPagination, WithTable;

    protected $paginationTheme = 'tailwind';
    
    // Reset pagination when filtering or searching
    protected $queryString = [
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'search' => ['except' => ''],
        'filters' => ['except' => []],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    protected function baseQuery()
    {
        return User::query();
    }

    protected function searchableFields()
    {
        return ['name', 'email'];
    }

    public function render()
    {
        $users = $this->getTableQuery()->paginate($this->perPage);

        return view('livewire.users.user-table', [
            'users' => $users,
            'columns' => [
                [
                    'field' => 'name',
                    'label' => 'Name',
                    'component' => 'table.columns.user-name'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email'
                ],
                [
                    'field' => 'created_at',
                    'label' => 'Joined Date'
                ],
            ],
            'filters' => [
                [
                    'field' => 'role',
                    'type' => 'select',
                    'label' => 'Role',
                    'options' => [
                        'admin' => 'Admin',
                        'user' => 'User',
                    ],
                ],
            ],
            'actions' => [
                [
                    'type' => 'link',
                    'label' => 'Edit',
                    'icon' => 'fas fa-edit',
                    'url' => fn($row) => route('profile.edit', $row),
                    'color' => 'indigo',
                ],
                [
                    'type' => 'button',
                    'label' => 'Delete',
                    'icon' => 'fas fa-trash',
                    'action' => 'deleteUser',
                    'color' => 'red',
                    'confirm' => 'Are you sure you want to delete this user?',
                    'condition' => fn($row) => auth()->id() !== $row->id,
                ],
            ],
            'createRoute' => null,
            'createText' => 'Add User',
        ]);
    }

    public function deleteUser($id)
    {
        if (auth()->id() !== $id) {
            User::find($id)->delete();
            session()->flash('success', 'User deleted successfully.');
        }
    }
}
