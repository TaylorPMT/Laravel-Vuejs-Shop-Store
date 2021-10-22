<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ckeditor Demo</title>
</head>
<body>
<div class="container">
    <div class="" style="margin-bottom: 50px; margin-top: 20px">Ckeditor Demo</div>
    <div class="row" id="app" >
        <ckeditor></ckeditor>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
