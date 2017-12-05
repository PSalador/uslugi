<?php

namespace Salador\Uslugi\Listeners\Masters;

use Salador\Uslugi\Http\Forms\Masters\MasterBaseForm;

class MasterBaseListener
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
        return MasterBaseForm::class;
    }
}
