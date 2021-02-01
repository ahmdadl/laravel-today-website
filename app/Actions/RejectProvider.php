<?php

namespace App\Actions;

use App\Models\Provider;
use TCG\Voyager\Actions\AbstractAction;

class RejectProvider extends AbstractAction
{
    public function getTitle()
    {
        return 'Reject';
    }

    public function getIcon()
    {
        return 'voyager-skull';
    }

    public function getPolicy()
    {
        return 'delete';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-danger pull-right mx-1 approve',
            'data-id' => $this->data->{$this->data->getKeyName()},
            'id'      => 'approve-'.$this->data->{$this->data->getKeyName()},
            'data-state' => Provider::Rejected,
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
