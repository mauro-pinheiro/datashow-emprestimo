<?php

namespace App\Http\Livewire;

use App\Http\Forms\EquipamentForm;
use App\Models\Equipament;
use Livewire\Component;

class EquipamentIndex extends Component
{
    public $header = "Equipamentos";

    public function render()
    {
        $query = null;
        if(!empty(request()->search)){
            $query = Equipament::where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(EquipamentForm::class)->search(null);
        $form = app(EquipamentForm::class)->index($query);
        return view('livewire.master-form', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
