<?php
namespace Salador\Uslugi\Events;
use Illuminate\Queue\SerializesModels;
use Salador\Uslugi\Http\Forms\Masters\MastersFormGroup;
class MasterEvent
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
    public function __construct(MastersFormGroup $form)
    {
        $this->form = $form;
    }
}