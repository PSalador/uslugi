<?php

namespace Salador\Uslugi\Fields;

use Orchid\Platform\Fields\Field;

class PlaceField extends Field
{
    /**
     * @var string
     */
    public $view = 'salador/uslugi::fields.place';

    /**
     * Required Attributes
     *
     * @var array
     */
    public $required = [
        'name',
    ];
}
