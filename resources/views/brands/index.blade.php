@extends('layout')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">Autómárkák</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('brands.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Új márka
        </a>
    </div>

    <div class="row">
        @foreach($brands as $brand)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    @if($brand->logo)
                        <img src="{{ asset('storage/brands/'.$brand->logo) }}" class="card-img-top p-3" alt="{{ $brand->name }}" style="height:120px;object-fit:contain;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $brand->name }}</h5>
                        <p class="text-muted">{{ $brand->country }}</p>
                        @if($brand->description)
                            <p class="card-text">{{ $brand->description }}</p>
                        @endif
                        <div class="btn-group">
                            <a href="{{ route('brands.edit', $brand) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Szerkesztés
                            </a>
                            <a href="{{ route('models.index', $brand) }}" class="btn btn-sm btn-outline-info">
        <i class="fas fa-list"></i> Modellek
    </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
