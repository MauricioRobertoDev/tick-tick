<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentIndex extends Component
{
    use WithPagination;

    public bool $showDeleteModal = false;

    public int $deleteDepartmentId = 0;

    public function render()
    {
        $departments = Department::paginate(20);

        return view('livewire.department-index', [
            'departments' => $departments,
        ]);
    }

     public function delete()
    {
        Department::findOrFail($this->deleteDepartmentId)->delete();
        $this->reset('showDeleteModal', 'deleteDepartmentId');
    }

    public function showDeleteModal($id)
    {

        dd(route('department.edit', ['id' => 1]));
        $this->showDeleteModal = true;
        $this->deleteDepartmentId = $id;
    }
}
