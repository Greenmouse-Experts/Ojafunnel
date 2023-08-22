<?php

use Illuminate\Support\Facades\View;

$html = View::make('builder.funnel-editor', [
    'currentpage' => $currentpage,
    'pages' => $pages,
    'funnel' => $funnel
])->render();

echo $html;
