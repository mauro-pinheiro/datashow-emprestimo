<?php

namespace App\Http\Forms;

use App\Models\Client;
use App\Models\Equipament;
use Grafite\Forms\Fields\Select;
use Grafite\Forms\Forms\LivewireForm;

class CartForm extends LivewireForm
{
    public $columns = 2;

    /**
     * Set the desired fields for the form.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('equipament', [
                'options' => Equipament::all(),
                'label' => 'Equipamento'
            ]),
            Select::make('client', [
                'option' => Client::all(),
                'label' => 'Cliente'
            ]),
        ];
    }
}
