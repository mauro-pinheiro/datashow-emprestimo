<?php

namespace App\Http\Livewire;

use App\Http\Forms\PermissionForm;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionSave extends Component
{
    public $data = [];
    public $role;
    public $header = "Permissions";

    protected $rules = [
        'data.name' => 'required|string',
        'data.roles[]' => 'nullable'
    ];

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
        $this->data['id'] = $permission->id;
        $this->data['name'] = $permission->name;
        if (!$permission->permissions->isEmpty()) {
            $this->data['roles[]'] = $permission?->roles->pluck('id');
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            Permission::updateOrCreate(['name' => $this->data['name']], ['name' => $this->data['name']])->roles()->sync($this->data['roles[]'] ?? []);
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        if ($this->role) {
            $form = app(PermissionForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->role);
        } else {
            $form = app(PermissionForm::class)
                ->setErrorBag($this->getErrorBag())
                ->create();
        }

        return view('livewire.master-form', [
            'form' => $form
        ]);
    }
}
