<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Models\Client;
use Livewire\Component;

class ClientIndex extends Component
{
    public $header = "Clientes";

    public function render()
    {
        $query = null;
        if(!empty(request()->search)){
            $query = Client::where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(ClientForm::class)->search(null);
        $form = app(ClientForm::class)->index($query);
        return view('livewire.master-form', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
