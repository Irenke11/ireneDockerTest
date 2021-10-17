@extends('layouts.app')

@section('content')
<user-ag-content :data="{{ json_encode($currencyList) }}" :openCurrencylist="{{ json_encode($openCurrencylist) }}"></user-ag-content>
@endsection
