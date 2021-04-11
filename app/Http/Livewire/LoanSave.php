<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Http\Forms\LoanForm;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Loan;
use Livewire\Component;

class LoanSave extends Component
{
    public $loan;
    public $data;
    public $role;
    public $header = "Emprestimos";

    protected $rules = [
        'data.id' => 'nullable',
        'data.equipament' => 'required',
        'data.client' => 'required',
        'data.user' => 'required',
    ];

    public function mount(Loan $loan)
    {
        if(empty($loan->id)){
            $this->loan = null;
            $this->data = [];
        } else {
            $this->loan = $loan;
            $this->data = $loan->toArray();
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            if($this->loan){
                $this->loan->fill($this->data);
                $this->loan->category()->associate(ClientCategory::find($this->data['category']));
                $this->loan->save();
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
        if ($this->loan) {
            $form = app(LoanForm::class)
                ->setErrorBag($this->getErrorBag())
                ->edit($this->loan);
        } else {
            $form = app(LoanForm::class)
                ->setErrorBag($this->getErrorBag())
                ->create();
        }

        return view('livewire.loan-index', [
            'form' => $form
        ]);
    }
}
