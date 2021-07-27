@extends('layouts.app')

@section('content')
<barchart-content 
:currencylist="{{ json_encode($currencyList) }}"  
:openCurrencylist="{{ json_encode($openCurrencyList) }}"  
:gametypelist="{{ json_encode($gametypeList) }}" 
:openGameTypeList="{{ json_encode($openGameTypeList) }}"  
>
</barchart-content>
@endsection
