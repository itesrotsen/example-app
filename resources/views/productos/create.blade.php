@extends('layouts.app')

@section('content')
<h1>Nuevo Producto</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('productos.store') }}" method="POST">
    @csrf
    <div>
        <label>Nombre:</label>
        <input type="text" name="no
