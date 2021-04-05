<?php

namespace App\Http\Livewire;

use App\Http\Forms\RoleForm as FormsRoleForm;
use Livewire\Component;

class RoleForm extends Component
{
    public $data;
    public $header = "Role";

    protected $rules = [
        'data.name' => 'required|string',
    ];

    public function render()
    {
        $form = app(FormsRoleForm::class)
            ->setErrorBag($this->getErrorBag())
            ->make($this->data);

        return view('livewire.role-form')->withForm($form);
    }
}
