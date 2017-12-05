<?php

namespace Salador\Uslugi\Behaviors;

class ServiceBase
{

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function fields() : array
    {
        return [
            'name'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'name',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Service'),
                'placeholder' => trans('salador/uslugi::uslugi.Service'),
            ],
            'measure'    => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'measure',
				'max'         => 30,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.measure'),
                'placeholder' => trans('salador/uslugi::uslugi.measure'),
            ],
        ];
    }

    /**
     * Grid View for post type.
     */
    public function grid() : array
    {
        return [];
    }
}
