<?php

namespace App\Http\Livewire;

use App\Http\Forms\RoleForm;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    public $header = "Roles";

    public function render()
    {
        $query = null;
        if(!empty(request()->search)){
            $query = Role::where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(RoleForm::class)->search(null);
        $form = app(RoleForm::class)->index($query);
        return view('livewire.master-form', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
