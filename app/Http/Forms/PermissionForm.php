<?php

namespace App\Http\Forms;

use App\Models\Role;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Forms\ModelForm;
use Grafite\Forms\Html\Button;
use Spatie\Permission\Models\Permission;

class PermissionForm extends ModelForm
{
    public $withLivewire = true;

    public $columns = 2;

    public $model = Permission::class;

    public $routePrefix = 'permissions';

    public $with = ['roles'];

    public $buttons = [
        'submit' => 'Salvar',
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

            HasMany::make('roles', [
                'label' => 'Roles',
                'model' => Role::class,
                'model_options' => [
                    'label' => 'name',
                    'value' => 'id',
                ]
            ]),
        ];
    }
}
