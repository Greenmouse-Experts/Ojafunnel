<head>  
    <title> {{config('app.name')}} | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" /> 
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" /> 
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet"> 
     <script src="http://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>
</head> 
<body>  
    <textarea class="mt-2" cols="80" id="editor" name="editor">
        {!! $templates[$id] !!}
    </textarea>
    <script>
        let editor = CKEDITOR.replace('editor', {
            fullPage: true,
            extraPlugins: 'docprops',
            allowedContent: true,
            height: 320,
            removeButtons: 'PasteFromWord',
            maximize: true,
        });  

        editor.on('instanceReady', function(event){   
            if(event.editor.getCommand('maximize').state == CKEDITOR.TRISTATE_OFF);
                event.editor.execCommand('maximize');
        }); 
    </script> 
</body>
</html>
