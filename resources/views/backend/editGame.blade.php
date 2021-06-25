@extends('layouts.app')

@section('content')
@if($edit)
<editgame-content :data="{{$data}}"></editgame-content>
@else
<addgame-content ></addgame-content>
@endif
@endsection