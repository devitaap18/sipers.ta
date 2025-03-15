@extends('layouts.app')

@section('title', 'Dashboard BPO')

@section('content')
<div class="container">
    <h2>Dashboard BPO</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
</div>
@endsection
