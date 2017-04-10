<?php

namespace App\Forms;

use App\Forms\Fields\EditorField;
use Kris\LaravelFormBuilder\Form;

class ArticleForm extends Form
{


    public function buildForm()
    {
        $model = $this->model;
        $contents = null;
         if (!is_null($model) && is_object($model)) {
            $contents = $model->detail->contents;
        }

        $tagsValue = [];
        if ($model && $model->tags && count($model->tags)) {

            foreach($model->tags as $tag) {
                $tagsValue[] = $tag->tag->name;
            }
        }

        // Add fields here...
        $this->add('id', 'hidden');
        $this->add('title', 'text', ['rules' => 'required|min:5']);
        $this->add('tags', 'text', ['rules' => 'max:255', 'value'=> implode(',', $tagsValue) ]);
        $this->add('thumb', 'ajax_upload_image_field', ['rules' => 'required']);
        $this->add('contents', 'editor_field', ['rules' => 'required | min:10 ','value' => is_null($contents) ? '' : $contents]);
        $this->add('submit', 'submit', ['value' => 'submit']);
    }
}