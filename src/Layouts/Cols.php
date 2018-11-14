<?php

namespace Salador\Uslugi\Layouts;

use Orchid\Platform\Fields\Builder;

abstract class Cols
{
    /**
     * @var string
     */
    public $template = "salador/uslugi::container.layouts.col";

    /**
     * @param $post
     *
     * @return array
     * @throws \Orchid\Platform\Exceptions\TypeException
     * @throws \Throwable
     */
    public function build($post)
    {
		//dd($this->fields());
		//$form = new Builder($this->fields(), $post);
		foreach ($this->fields() as $key => $field) {
			//dd($field);
			$forms[] = (new Builder([$key => $field], $post))->generateForm();
		}
		//dd($forms);
        return view($this->template, [
            'forms' => $forms,
        ])->render();
    }

    /**
     * @return array
     */
    public function fields() : array
    {
        return [];
    }
}
