<?php

use Illuminate\Support\Facades\View;

$html = View::make('builder.page-builder-editor', [
    'currentpage' => $currentpage,
    'pages' => $pages,
    'pbuilder' => $pbuilder
])->render();

echo $html;
