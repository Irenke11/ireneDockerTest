@extends('layouts.app')

@section('content')
<addplayer-content 
:data="{{ json_encode($currencyList) }}"  
:openCurrencylist="{{ json_encode($openCurrencylist) }}"  
:playerInfo="{{ json_encode($playerInfo ?? [])}}"
></addplayer-content>
@endsection
