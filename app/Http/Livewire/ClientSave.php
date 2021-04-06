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
        $this->client = $client;
        $this->data['id'] = $client->id;
        $this->data['name'] = $client->name;
        $this->data['category'] = $client->client_category_id;
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
                Client::create($this->data);
            }
            $this->dispatchBrowserEvent('swal', ['title' => 'Salvo Com Sucesso!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
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
