<?php

namespace Salador\Uslugi\Fields;

use Orchid\Platform\Fields\Field;
use Orchid\Platform\Core\Models\Role;
use Orchid\Platform\Core\Models\User;

class SelectField extends Field
{
    /**
     * @var string
     */
    public $view = 'salador/uslugi::fields.select';
	

}
