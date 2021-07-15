@extends('layouts.app')

@section('content')
<dailybets-content 
:currencylist="{{ json_encode($currencyList) }}"  
:openCurrencylist="{{ json_encode($openCurrencyList) }}"  
:gametypelist="{{ json_encode($gametypeList) }}" 
:openGameTypeList="{{ json_encode($openGameTypeList) }}"  
></dailybets-content>
@endsection
