<?php

namespace Salador\Uslugi\Listeners\Services;

use Salador\Uslugi\Http\Forms\Services\ServiceBaseForm;

class ServiceBaseListener
{
    /**
     * Handle the event.
     *
     * @return string
     *
     * @internal param UserEvent $event
     */
    public function handle() : string
    {
        return ServiceBaseForm::class;
    }
}
