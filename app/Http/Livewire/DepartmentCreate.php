<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Closure;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class DepartmentCreate extends Component
{
    public string $name;
    public array $agents = [];

    public function render()
    {
        $agents = User::select(['id', 'name', 'email', 'avatar'])
            ->whereHas("roles", fn($q) => $q->where("name", "agent"))
            ->get();

        return view('livewire.department-create', [
            'all_agents' => $agents
        ]);
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
        dd($this->agents);
        $this->validate([
            'name' => 'required|string|max:255',
            'agents' => 'array|exists:users,id',
            'agents.*' => 'int'
        ]);

        Department::create(['name' => $this->name])->agents()->attach($this->agents);

        return redirect()->to(route('department.index'));
    }
}
