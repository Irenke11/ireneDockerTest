@extends('layouts.app')

@section('content')
<games-content :data="{{ json_encode($gametypeList) }}" ></games-content>
@endsection
