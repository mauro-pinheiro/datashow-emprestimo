<?php

namespace App\Http\Livewire;

use App\Http\Forms\UserForm;
use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public $header = "Usuários";

    public function render()
    {
        $query = null;
        if(!empty(request()->search)){
            $query = User::where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(UserForm::class)->search(null);
        $form = app(UserForm::class)->index($query);
        return view('livewire.master-form', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
