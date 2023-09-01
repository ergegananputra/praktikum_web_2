@extends('tugas_praktikum3')

@section('title_appbar')
    <h1 style="text-align: center; font-size: 50pt; width: 100%">Tugas Praktikum Routing, View, dan Blade Laravel</h1>
@endsection

@section('button_1')
    <div class="button" onclick="myButton('{{ $satu }}')">Press Me </div>
@endsection

@section('button_2')
    <div class="button" onclick="myButton('{{ $dua }}')">Press Me</div>
@endsection

@section('button_3')
    <div class="button" onclick="myButton('{{ $tiga }}')">Press Me</div>
@endsection