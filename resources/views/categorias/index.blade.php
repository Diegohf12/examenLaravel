@extends('layouts.app')

@section('content')
    <div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between">
            <h2>Categorías</h2>
            <button class="btn btn-outline-primary" onclick="nuevaCategoria()" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                Nueva categoría <i class="fa-solid fa-tag"></i>
            </button>
        </div>
        @include('categorias.tabla')
    </div>

    @include('categorias.modal')
@endsection

@section('scripts')
@include('categorias.scripts')
@endsection