<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientCategory;
use Livewire\Component;

class ClientSave extends Component
{
    public $data;
    public $role;
    public $header = "Clietes";

    protected $rules = [
        'data.id' => 'nullable',
        'data.name' => 'required|string',
        'data.category' => 'required'
    ];

    public function mount(Client $client)
    {
        $this->data = $client;
    }

    public function submit()
    {
        $this->validate();
        try {
            $category = ClientCategory::find($this->data->category);
            $client = Client::make($this->data->toArray());
            $client->id = $this->data->id;
            $client->category()->associate($category);
            $client->save();
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        if ($this->data) {
            dd($this->data);
            $form = app(ClientForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->data);
        } else {
            $form = app(ClientForm::class)
                ->setErrorBag($this->getErrorBag())
                ->create();
        }

        return view('livewire.master-form', [
            'form' => $form
        ]);
    }
}
