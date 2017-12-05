<?php
namespace Salador\Uslugi\Events;
use Illuminate\Queue\SerializesModels;

use Salador\Uslugi\Http\Forms\Prices\PricesFormGroup;
class PriceEvent
{
    use SerializesModels;
    /**
     * @var
     */
    protected $form;
    /**
     * Create a new event instance.
     * SomeEvent constructor.
     *
     * @param ServicesFormGroup $form
     */
    public function __construct(PricesFormGroup $form)
    {
        $this->form = $form;
    }
}