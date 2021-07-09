@extends('layouts.app')

@section('content')
<addplayer-content :data="{{ json_encode($currencyList) }}" 
:playerInfo="{{ json_encode($playerInfo ?? '')}}"></addplayer-content>
@endsection
