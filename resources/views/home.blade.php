@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">HI</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!<br>
                    <a  target="_blank"  href="https://drive.google.com/file/d/1n1Jc7IyZT6CoozszuqssAk0BG6eGVroY/view?usp=sharing">流程圖</a><br>
                    <a  target="_blank"  href="https://drive.google.com/file/d/14cYjKb0AOAqn_8ZfgfyHJJTDNRlfxw9e/view?usp=sharing">架構圖</a><br>
                    <a  target="_blank"  href="https://docs.google.com/document/d/1fOQUIcPM2SW9LV2xzSWTQ2YXqYrsv5uVaf5svXG9Jzk/edit?usp=sharing">api説明</a>
                </div>
            </div>
        </div>
            <!-- <example-component></example-component> -->
    </div>
</div>
@endsection
