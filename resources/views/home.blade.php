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

               <v-card
    class="mx-auto"
    max-width="400"
  >
    <v-img
      class="white--text align-end"
      height="200px"
      src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
    >
      <v-card-title>Top 10 Australian beaches</v-card-title>
    </v-img>

    <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

    <v-card-text class="text--primary">
      <div>Whitehaven Beach</div>

      <div>Whitsunday Island, Whitsunday Islands</div>
    </v-card-text>

    <v-card-actions>
      <v-btn
        color="orange"
        text
      >
        Share
      </v-btn>

      <v-btn
        color="orange"
        text
      >
        Explore
      </v-btn>
    </v-card-actions>
  </v-card>



            </div>
        </>
    </div>
</div>
@endsection
