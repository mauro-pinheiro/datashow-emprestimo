<?php

namespace App\Http\Forms;

use App\Models\Role;
use App\Models\User;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Email;
use Grafite\Forms\Fields\Hidden;
use Grafite\Forms\Fields\Password;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Forms\ModelForm;
use Spatie\Permission\Models\Permission;

class UserForm extends ModelForm
{
    public $withLivewire = true;
    public $columns = 2;
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = User::class;

    /**
     * Required prefix of routes
     *
     * Can be `user` for all `user.`
     * name routes.
     *
     * @var string
     */
    public $routePrefix = 'users';

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
            Hidden::make('id'),
            Text::make('name',[
                'required' => true,
                'label' => 'Nome'
            ]),
            Email::make('email', [
                'required' => true,
                'label' => 'Email'
            ]),

            HasMany::make('roles', [
                'model' => Role::class,
                'label' => 'Roles',
                'model_options' => [
                    'value' => 'id',
                    'label' => 'name'
                ]
            ]),

            HasMany::make('permissions', [
                'model' => Permission::class,
                'label' => 'Permissions',
                'model_options' => [
                    'value' => 'id',
                    'label' => 'name'
                ]
            ])
        ];
    }
}
