<?php

namespace App\Http\Livewire;

use App\Http\Forms\ClientForm;
use App\Http\Forms\LoanForm;
use App\Models\Client;
use App\Models\Loan;
use Livewire\Component;

class LoanIndex extends Component
{
    public $header = "Emprestimos";

    public function render()
    {
        $query = null;
        if(!empty(request()->search)){
            $query = Loan::where('name', 'like' , '%'.request('search').'%');
        }
        $search = app(LoanForm::class)->search(null);
        $form = app(LoanForm::class)->index($query);
        return view('livewire.loan-index', [
            'search' => $search,
            'form' => $form,
        ]);
    }
}
