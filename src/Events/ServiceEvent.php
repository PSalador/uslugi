<?php
namespace Salador\Uslugi\Events;
use Illuminate\Queue\SerializesModels;
use Salador\Uslugi\Http\Forms\Services\ServicesFormGroup;
class ServiceEvent
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
    public function __construct(ServicesFormGroup $form)
    {
        $this->form = $form;
    }
}