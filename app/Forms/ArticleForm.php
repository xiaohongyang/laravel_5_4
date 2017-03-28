<?php

namespace App\Forms;

use App\Forms\Fields\EditorField;
use Kris\LaravelFormBuilder\Form;

class ArticleForm extends Form
{

    public $model;
    public function __construct($model = null)
    {
        if (!is_null($model))
            $this->model = $model;
    }

    public function buildForm()
    {
        // Add fields here...
        $this->add('title', 'text', ['rules' => 'required|min:5', 'value'=>'title']);
        $this->add('contents', 'editor_field', ['value' => key_exists('contents', $this->data) ? $this->data['contents'] : '']);
        $this->add('submit', 'submit', ['value' => 'submit']);
    }
}