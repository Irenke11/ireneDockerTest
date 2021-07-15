@extends('layouts.app')

@section('content')
<games-content :data="{{ json_encode($gametypeList) }}" 
:opengametypelist="{{ json_encode($openGameTypeList) }}"></games-content>
@endsection
