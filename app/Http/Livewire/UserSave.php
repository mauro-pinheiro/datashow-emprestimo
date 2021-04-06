<?php

namespace App\Http\Livewire;

use App\Http\Forms\UserForm;
use App\Models\User;
use Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSave extends Component
{
    public $user;
    public $data;
    public $role;
    public $header = "Role";

    protected $rules = [
        'data.name' => 'required|string',
        'data.email' => 'required|email',
        'data.roles' => 'nullable',
        'data.permissions[]' => 'nullable'
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->data['id'] = $user->id;
        $this->data['name'] = $user->name;
        $this->data['email'] = $user->email;
        if (!$user->permissions->isEmpty()) {
            $this->data['permissions[]'] = $user->permissions->pluck('id');
        }
        if (!$user->roles->isEmpty()) {
            $this->data['roles[]'] = $user->roles->pluck('id');
        }
    }

    public function submit()
    {
        // dd($this->data);
        // dd($this->user, $this->data);
        $this->validate();
        $this->data['password'] = Hash::make('123@1234');
        try {
            if ($this->user) {
                $this->user->fill($this->data);
                if (!empty($this->data['permissions[]'])) {
                    foreach ($this->data['permissions[]'] as $permission) {
                        $this->user->givePermissionTo($permission);
                    }
                }
                if (!empty($this->data['roles[]'])) {
                    foreach ($this->data['roles[]'] as $role) {
                        $this->user->assignRole($role);
                    }
                }
                $this->user->save();
            } else {
                User::create($this->data);
            }
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        if ($this->user) {
            $form = app(UserForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->user);
        } else {
            $form = app(UserForm::class)
                ->setErrorBag($this->getErrorBag())
                ->create();
        }

        return view('livewire.master-form', [
            'form' => $form
        ]);
    }
}
