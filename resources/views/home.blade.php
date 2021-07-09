@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">HI,You are logged in!</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="list-group">
                        <a  target="_blank" class="list-group-item list-group-item-action"   href="https://drive.google.com/file/d/1n1Jc7IyZT6CoozszuqssAk0BG6eGVroY/view?usp=sharing">流程圖</a><br>
                        <a  target="_blank" class="list-group-item list-group-item-action"   href="https://drive.google.com/file/d/14cYjKb0AOAqn_8ZfgfyHJJTDNRlfxw9e/view?usp=sharing">架構圖</a><br>
                        <a  target="_blank" class="list-group-item list-group-item-action"   href="https://docs.google.com/document/d/1fOQUIcPM2SW9LV2xzSWTQ2YXqYrsv5uVaf5svXG9Jzk/edit?usp=sharing">api説明</a><br>
                        <a  target="_blank" class="list-group-item list-group-item-action"  href="https://github.com/Irenke11/ireneDockerTest/tree/fe5ea953de1efc13d6209c9c443f86fcadf3c6e2">Github</a><br>
                        <a  target="_blank" class="list-group-item list-group-item-action"  href="https://restless-crescent-88219.postman.co/workspace/My-Workspace~aa1240da-abd1-415b-8f12-034bd4352767/collection/16052795-fca1100f-049a-416a-9f21-18d4bdad0c20?ctx=documentation">Postman</a>
                    </div>
                </div>
            </div>
        </div>
            <!-- <example-component></example-component> -->
    </div>
</div>
@endsection
