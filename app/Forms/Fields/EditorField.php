<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/3/28
 * Time: 16:42
 */

namespace App\Forms\Fields;
use Kris\LaravelFormBuilder\Fields\FormField;

class EditorField extends FormField
{

    /**
     * Get the template, can be config variable or view path
     *
     * @return string
     */
    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/fields/datetime.blade.php
        return 'fields.editor';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options['editorData'] = (!is_null($this->options['value']) && strlen($this->options['value']) > 0) ? $this->options['value'] : '';

        return parent::render($options, $showLabel, $showField, $showError);
    }


}