<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmailLayout extends Component
{
    public function __construct()
    {
        //
    }
    public function render()
    {
        return view('themes.email.main');
    }
}
