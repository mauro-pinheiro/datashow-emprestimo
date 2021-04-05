<?php

namespace App\Http\Livewire;

use App\Http\Forms\PermissionForm;
use App\Http\Forms\RoleForm;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionIndex extends Component
{
    public $header = "Permissions";

    public function render()
    {
        $query = null;
        if(!empty(request()->search)){
            $query = Permission::where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(PermissionForm::class)->search(null);
        $form = app(PermissionForm::class)->index($query);
        return view('livewire.master-form', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
