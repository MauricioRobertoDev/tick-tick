<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;

class DepartmentEdit extends Component
{
    public int $department_id;
    public string $name;
    public array $agents = [];

    public function mount($id)
    {
        $department = Department::with('agents:id')->findOrFail($id, [
            'departments.id',
            'departments.name',
        ]);

        $this->department_id = $department->id;
        $this->name = $department->name;
        $this->agents = $department->agents->modelKeys();
    }

    public function render()
    {
        $agents = User::select(['id', 'name', 'email', 'avatar'])
            ->whereHas("roles", fn($q) => $q->where("name", "agent"))
            ->get();

        return view('livewire.department-edit', ['all_agents' => $agents]);
    }

    public function add_agent(int $agent_id)
    {
        if(in_array($agent_id, $this->agents)) {
            $pos = array_search($agent_id, $this->agents);
            array_splice($this->agents, $pos, 1);
        } else {
            $this->agents[] = $agent_id;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'agents' => 'array|exists:users,id',
            'agents.*' => 'int'
        ]);

        $department = Department::find($this->department_id);
        $department->update(['name' => $this->name]);
        $department->agents()->sync($this->agents);

        session()->flash('status', 'Departamento atualizado.');
    }

}
