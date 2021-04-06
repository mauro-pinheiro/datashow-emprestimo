<?php

namespace App\Http\Livewire;

use App\Http\Forms\RoleForm;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleSave extends Component
{
    public $data;
    public $role;
    public $header = "Role";

    protected $rules = [
        'data.name' => 'required|string',
        'data.permissions[]' => 'nullable'
    ];

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->data['id'] = $role->id;
        $this->data['name'] = $role->name;
        if (!$role->permissions->isEmpty()) {
            $this->data['permissions[]'] = $role?->permissions?->pluck('id');
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            Role::updateOrCreate(['name' => $this->data['name']], ['name' => $this->data['name']])->syncPermissions($this->data['permissions[]']);
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        if ($this->role) {
            $form = app(RoleForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->role);
        } else {
            $form = app(RoleForm::class)
                ->setErrorBag($this->getErrorBag())
                ->create();
        }

        return view('livewire.master-form', [
            'form' => $form
        ]);
    }
}
