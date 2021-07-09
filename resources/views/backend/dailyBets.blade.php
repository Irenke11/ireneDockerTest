@extends('layouts.app')

@section('content')
<dailybets-content :currencylist="{{ json_encode($currencyList) }}"  :gametypelist="{{ json_encode($gametypeList) }}" ></dailybets-content>
@endsection
