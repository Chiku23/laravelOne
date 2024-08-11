<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ErrorPopup extends Component
{
    public $errors;
    public $successMessage;

    public function __construct($errors = null, $successMessage = null)
    {
        $this->errors = $errors;
        $this->successMessage = $successMessage;
    }

    public function render()
    {
        return view('components.error-popup');
    }
}
