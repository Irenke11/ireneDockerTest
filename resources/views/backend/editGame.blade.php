@extends('layouts.app')

@section('content')
 <addgame-content :data="{{ json_encode($gametypeList) }}" :info="{{ json_encode($gameInfo ?? '')}}"></addgame-content>
@endsection
