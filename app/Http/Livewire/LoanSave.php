<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Http\Forms\LoanForm;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Equipament;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
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
        'data.reservation_date' => 'nullable',
        'data.load_date' => 'nullable',
        'data.return_date' => 'nullable',
        'data.status' => 'nullable',
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
                $this->loan->equipament()->associate(Equipament::find($this->data['equipament']));
                $this->loan->user()->associate(User::find($this->data['user']));
                $this->loan->client()->associate(Client::find($this->data['client']));
                $this->loan->save();
            } else {
                $this->loan = Loan::make([
                    'equipament_id' => $this->data['equipament'],
                    'user_id' => $this->data['user'],
                    'client_id' => $this->data['client'],
                    'reservation_date' => Carbon::parse($this->data['reservation_date']),
                    'load_date' => Carbon::parse($this->data['load_date']),
                    'due_date' => Carbon::parse($this->data['due_date']),
                    'return_date' => Carbon::parse($this->data['return_date']),
                    'return_date' => Carbon::parse($this->data['return_date']),
                ]);
                $this->loan->save();
                $this->loan = null;
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
