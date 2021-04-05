<?php

namespace App\Http\Forms;

use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Forms\LivewireForm;
use Spatie\Permission\Models\Permission;

class RoleForm extends LivewireForm
{
    public $columns = 2;

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

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('name', [
                'required' => true,
                'label' => 'Nome'
            ]),

            HasMany::make('permission', [
                'label' => 'Permissoes',
                'model' => Permission::class,
                'model_options' => [
                    'label' => 'name',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])
        ];
    }
}
