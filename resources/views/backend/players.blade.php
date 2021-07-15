@extends('layouts.app')

@section('content')
<players-content :data="{{ json_encode($currencyList) }}" :openCurrencylist="{{ json_encode($openCurrencylist) }}"></players-content>
@endsection
