@extends('layouts.app')

@section('content')
 <editgame-content 
  :data="{{ json_encode($gametypeList) }}" :info="{{ json_encode($gameInfo ?? [])}}" :getopengametypelist="{{ json_encode($getOpenGameTypeList)}}">
</editgame-content>
@endsection
