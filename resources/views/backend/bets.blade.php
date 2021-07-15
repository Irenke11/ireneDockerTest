@extends('layouts.app')

@section('content')
<bets-content  :currencylist="{{ json_encode($currencyList) }}"  
:configcurrency="{{ json_encode($configCurrency) }}"
></bets-content>
@endsection
