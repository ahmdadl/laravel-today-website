<?php

namespace App\Actions;

use App\Models\Provider;
use TCG\Voyager\Actions\AbstractAction;

class ApproveProvider extends AbstractAction
{
    public function getTitle()
    {
        return 'Approve';
    }

    public function getIcon()
    {
        return 'voyager-check';
    }

    public function getPolicy()
    {
        return 'delete';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right approve',
            'data-id' => $this->data->{$this->data->getKeyName()},
            'id'      => 'approve-'.$this->data->{$this->data->getKeyName()},
            'data-state' => Provider::APPROVED,
        ];
    }

    public function getDefaultRoute()
    {
        return 'javascript:;';
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'providers';
    }
}
