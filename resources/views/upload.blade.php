<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body >
    <div class="col-xs-12 col-sm-12 col-md-12">

        {!! Form::open(['route' => ['processupload'], 'method' => 'POST', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                      
                <div class="form-group">
                    XML File <br>    
                    {!! Form::file('xmlfile', null, ['class' => 'form-control', 'placeholder' => 'XMLFile', 'required']) !!}
                </div>
                @error('xmlfile')
                <div class="alert alert-danger">
                    {{ $message }} 
                </div>                   
                @enderror
                {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
               
    </div>
    




        
    </body>
</html>
