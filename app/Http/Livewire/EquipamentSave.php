<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Http\Forms\EquipamentForm;
use App\Models\Equipament;
use Livewire\Component;

class EquipamentSave extends Component
{
    public $equipament;
    public $data;
    public $role;
    public $header = "Equipamentos";

    protected $rules = [
        'data.id' => 'nullable',
        'data.name' => 'required|string',
    ];

    public function mount(Equipament $equipament)
    {
        $this->equipament = $equipament;
        $this->data['id'] = $equipament->id;
        $this->data['name'] = $equipament->name;
    }

    public function submit()
    {
        $this->validate();
        try {
            if($this->equipament){
                $this->equipament->fill($this->data);
                $this->equipament->save();
            } else {
                Equipament::create($this->data);
            }
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        if ($this->equipament) {
            $form = app(EquipamentForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->equipament);
        } else {
            $form = app(EquipamentForm::class)
                ->setErrorBag($this->getErrorBag())
                ->create();
        }

        return view('livewire.master-form', [
            'form' => $form
        ]);
    }
}
