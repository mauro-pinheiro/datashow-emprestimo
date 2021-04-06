<?php

namespace App\Http\Forms;

use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Forms\ModelForm;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends ModelForm
{
    public $withLivewire = true;
    public $columns = 2;

    public $model = Role::class;

    public $routePrefix = 'roles';

    public $with = ['permissions'];

    public $paginate = 10;

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

            HasMany::make('permissions', [
                'label' => 'Permissoes',
                'model' => Permission::class,
                'model_options' => [
                    'label' => 'name',
                    'value' => 'id',
                ]
            ])
        ];
    }
}
