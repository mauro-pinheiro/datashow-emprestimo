<?php

namespace App\Http\Forms;

use App\Models\Client;
use App\Models\Equipament;
use App\Models\Loan;
use App\Models\User;
use Grafite\Forms\Fields\Date;
use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\Hidden;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Forms\ModelForm;

class LoanForm extends ModelForm
{
    public $withLivewire = true;
    public $columns = 3;
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Loan::class;

    /**
     * Required prefix of routes
     *
     * Can be `user` for all `user.`
     * name routes.
     *
     * @var string
     */
    public $routePrefix = 'loans';

    /**
     * Buttons and values
     *
     * You can add a `cancel => Cancel`
     * which will create a cancel button.
     * Then you can set it's route with the
     * `buttonLinks` property.
     *
     * @var array
     */
    public $buttons = [
        'submit' => 'Save'
    ];

    public $with = ['equipament', 'client', 'user'];

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            Hidden::make('id'),
            HasOne::make('equipament', [
                'required' => true,
                'label' => 'Equipamento',
                'model' => Equipament::class,
                'model_options' => [
                    'value' => 'id',
                    'label' => 'name',
                ]
            ]),
            HasOne::make('client', [
                'required' => true,
                'label' => 'Professor',
                'model' => Client::class,
                'model_options' => [
                    'value' => 'id',
                    'label' => 'name',
                ]
            ]),
            HasOne::make('user', [
                'required' => true,
                'label' => 'Funcionário',
                'model' => User::class,
                'model_options' => [
                    'value' => 'id',
                    'label' => 'name',
                ]
            ]),

            Date::make('reservation_date', [
                'label' => 'Data de Reserva',
            ]),
            Date::make('load_date', [
                'label' => 'Data de Retirada'
            ]),
            Date::make('due_date', [
                'label' => 'Data de Devolução'
            ]),
            Date::make('return_date', [
                'label' => 'Data de Retorno'
            ]),

            Text::make('status', [
                'label' => 'Status'
            ]),
        ];
    }
}
