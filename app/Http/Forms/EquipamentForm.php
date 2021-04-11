<?php

namespace App\Http\Forms;

use App\Models\Equipament;
use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\Hidden;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Forms\ModelForm;

class EquipamentForm extends ModelForm
{
    public $withLivewire = true;
    public $columns = 2;

    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Equipament::class;

    /**
     * Required prefix of routes
     *
     * Can be `user` for all `user.`
     * name routes.
     *
     * @var string
     */
    public $routePrefix = 'equipaments';

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

    // public $with = ['category'];

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            Hidden::make('id', [
                'visible' => false,
            ]),

            Text::make('name',[
                'required' => true,
                'label' => 'Nome',
            ]),
        ];
    }
}
