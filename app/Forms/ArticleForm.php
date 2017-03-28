<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ArticleForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this->add('title', 'text', ['rules' => 'required|min:5']);
        $this->add('submit', 'submit', ['value' => 'submit']);
    }
}
