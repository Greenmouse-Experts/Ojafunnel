<?php

use Illuminate\Support\Facades\View;

$html = View::make('builder.funnel-editor', [
    'currentpage' => $currentpage,
    'pages' => $pages
])->render();

echo $html;