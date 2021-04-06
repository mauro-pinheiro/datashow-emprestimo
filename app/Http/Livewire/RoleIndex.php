<?php

namespace App\Http\Livewire;

use App\Http\Forms\RoleForm;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoleIndex extends Component
{
    public $header = "Roles";

    public function render()
    {
        $query = Role::query();
        if(!empty(request()->search)){
            $query = $query->where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(RoleForm::class)->search(null);
        $form = app(RoleForm::class)->index($query);
        return view('livewire.master-form', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
