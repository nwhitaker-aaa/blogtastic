<?php

namespace App\Helpers\Macros\Traits;

/**
 * Class Form.
 */
trait Form
{
    /**
     * @param $name
     * @param $value
     * @param $options
     * @param $errors
     * @param $formGroupClasses
     * @return string
     */
    public function aaaText($name, $value = null, $options = [], $errors = null, $formGroupClasses = null): string
    {
        $inputType = 'text';

        $defaultClasses = [
            'form-control',
            'form-white'
        ];
        $defaultFormGroupClasses = [
            'form-group',
        ];

        $options['class'] = (isset($options['class'])) ?
            array_merge($defaultClasses, explode(' ', $options['class'])) : $defaultClasses;

        $options['class'] = implode(' ', $options['class']);

        if($errors && $errors->has($name)){
            $defaultFormGroupClasses[] = 'has-error';
        }

        if(in_array('required', $options, true)){
            $defaultFormGroupClasses[] = 'required';
        }

        if(isset($options['type']) && is_string($options['type'])){
            $inputType = $options['type'];
            unset($options['type']);
        }

        if(is_array($formGroupClasses)){
            $defaultFormGroupClasses = array_merge($defaultFormGroupClasses, $formGroupClasses);
        }

        $html = '<div class="'.implode(' ', $defaultFormGroupClasses).'">';
        $html .= $this->label($name, $options['placeholder'] ?? null, ['class' => 'control-label']);

        $html .= $this->buildInputFromType($inputType, $name, $value, $options);

        if($errors){
            $html .=  $errors->first($name, '<div id="'.$name.'-error" class="form-error">:message</div>');
        }
        $html .= '</div>';

        return $html;
    }

    private function buildInputFromType($type, $name, $value, $options)
    {
        switch ($type) {
            case 'email':
                $input = $this->email($name, $value, $options);
                break;

            case 'password':
                $input = $this->password($name, $options);
                break;

            default:
                $input = $this->text($name, $value, $options);
                break;
        }

        return $input;
    }


    public function aaaTextarea($name, $value = null, $options = [])
    {
        $defaultClasses = [
            'form-control',
            'form-white'
        ];

        $options['class'] = (isset($options['class'])) ?
            array_merge($defaultClasses, explode(' ', $options['class'])) : $defaultClasses;

        $options['class'] = join(' ', $options['class']);

        return $this->textarea($name, $value, $options);
    }
}
