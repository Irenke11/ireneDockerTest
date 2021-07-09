@extends('layouts.app')

@section('content')
<players-content :data="{{ json_encode($currencyList) }}"></players-content>
@endsection
