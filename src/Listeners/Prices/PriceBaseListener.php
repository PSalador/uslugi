<?php

namespace Salador\Uslugi\Listeners\Prices;

use Salador\Uslugi\Http\Forms\Prices\PriceBaseForm;

class PriceBaseListener
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
        return PriceBaseForm::class;
    }
}
