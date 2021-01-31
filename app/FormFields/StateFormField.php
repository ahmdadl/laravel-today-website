<?php

namespace App\FormFields;

use ReflectionClass;
use ReflectionClassConstant;
use TCG\Voyager\FormFields\AbstractHandler;

class StateFormField extends AbstractHandler
{
    protected $codename = 'state';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        $value = isset($dataTypeContent->{$row->field})
            ? $dataTypeContent->{$row->field}
            : $row->field;

        $provider_class = new ReflectionClass('App\Models\Provider');
        $states = $provider_class->getConstants(
            ReflectionClassConstant::IS_PRIVATE,
        );

        return view('formfields.state', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent,
            'value' => (int) $value,
            'states' => $states,
        ]);
    }
}
