<?php

use Illuminate\Support\Facades\View;

$html = View::make('builder.editor', [
    'page' => $page
])->render();

echo $html;