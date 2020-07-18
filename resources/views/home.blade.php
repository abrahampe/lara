@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                     
                </div>
                {{Configura::readThemes('selected')}}
                  <example-component class="mb-5"></example-component>  

                <div class="alert alert-danger"> {{Config::get('themes.selected.default') ? Config::get('themes.selected.default') :  asset('css/app.css') }} </div>         
                <div class="alert alert-danger">  
                {{config(['themes.selected.default' => 'css/dark.css'])}}
                @foreach(config('themes.avaliable') as $key => $value)
                    {{ $key }}   {{ $value }}
                @endforeach 
                {{setting(['themes.avaliable.dark' => 'css/dark.js'])->save()}}
                <div class="alert alert-primary">{{setting('themes.avaliable.flatly')}} </div>
                </div>    




            </div>
        </>
    </div>
</div>
@endsection
