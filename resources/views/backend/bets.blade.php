@extends('layouts.app')

@section('content')
<bets-content  :currencylist="{{ json_encode($currencyList) }}"  :gametypelist="{{ json_encode($gametypeList) }}"   ></bets-content>
@endsection
