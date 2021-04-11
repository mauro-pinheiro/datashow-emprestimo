<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientCategory;
use Livewire\Component;

class ClientSave extends Component
{
    public $client;
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
        if(empty($client->id)){
            $this->client = null;
            $this->data = [];
        } else {
            $this->client = $client;
            $this->data = $client->toArray();
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            if($this->client){
                $this->client->fill($this->data);
                $this->client->category()->associate(ClientCategory::find($this->data['category']));
                $this->client->save();
            } else {
                $this->client = Client::make($this->data);
                $this->client->category()->associate(ClientCategory::find($this->data['category']));
                $this->client->save();
            }
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        // dD($this->client);
        if ($this->client) {
            $form = app(ClientForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->client);
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
