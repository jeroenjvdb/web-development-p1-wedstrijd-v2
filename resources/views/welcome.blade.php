@extends('master')

@section('content')
    <div class="row">
        <div class="columns medium-offset-1 columns medium-4 lowertop">
            <h1>ssst.... </br>here plays the <img src="img/duvel.png" alt="duvel" class="logo"></h1>
            <h3>about the competition</h3>
            <p>
                Do you wanna win a case of Duvel?</br>
                Or maybe you'd rather have a designer glass?</br>
                this is your chance!</br>
                upload your best pic with the duvel logo clearly on it!</br>
                and invite all your friends to ike your photo</br>
                a winner every week!</br>
                join us now and have more chance to win!
            </p>
            <div class="columns medium-offset-3 columns medium-6 playNow center">
                <h4><a href="{{ route('competition') }}" >play now!</a></h4>
            </div>
        </div>
        <div class="columns medium-6"><img src="img/duvel-bottle-plus-glass.png" alt="a duvel bottle and it's glass"></div>
    </div>
    @if($winners && $winners->first())
        <div class="row">
            <h2>the winners</h2>
                @foreach($winners as $i => $winner)
                    <div class="columns medium-3 @if($i == count($winners) - 1) end @endif">
                        
                        <img src="{{$winner->competitor->picture_url}}" alt="test">
                    </div>
                @endforeach

        </div>
    @endif
@stop