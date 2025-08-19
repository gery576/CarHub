@extends('layout')
@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <!-- Képek -->
        @if($car->images && count($car->images) > 0)
          <div id="carImagesCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($car->images as $key => $image)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <img src="{{ asset('storage/cars/' . $image->path) }}" class="d-block w-100" style="height:350px;object-fit:cover;" alt="Autó kép">
                </div>
              @endforeach
            </div>
            @if(count($car->images) > 1)
              <button class="carousel-control-prev" type="button" data-bs-target="#carImagesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="width:2rem;height:2rem;background-size:80% 80%;background-color:rgba(0,0,0,0.3);border-radius:50%;"></span>
                <span class="visually-hidden">Előző</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carImagesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="width:2rem;height:2rem;background-size:80% 80%;background-color:rgba(0,0,0,0.3);border-radius:50%;"></span>
                <span class="visually-hidden">Következő</span>
              </button>
            @endif
          </div>
        @else
          <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:350px;">
            <span>Nincs kép</span>
          </div>
        @endif

        <div class="card-body">
          <h2 class="card-title fw-bold mb-3">{{ $car->marka }} {{ $car->modell }}</h2>
          <div class="row mb-2">
            <div class="col-6"><strong>Évjárat:</strong> {{ $car->evjarat }}</div>
            <div class="col-6"><strong>Üzemanyag:</strong> {{ ucfirst($car->uzemanyag) }}</div>
          </div>
          <div class="mb-3">
            <span class="fs-4 text-success fw-bold">{{ number_format($car->ar,0,',',' ') }} Ft</span>
          </div>
          <div class="mb-3">
            <strong>Leírás:</strong>
            <p>{{ $car->leiras }}</p>
          </div>
          @if($car->extrak)
            <div class="mb-2">
              <strong>Extrák:</strong>
              <span>{{ $car->extrak }}</span>
            </div>
          @endif
          <ul class="list-unstyled mb-2">
            <li><strong>Kilométeróra:</strong> {{ $car->km_ora }}</li>
            <li><strong>Teljesítmény:</strong> {{ $car->teljesitmeny }} LE</li>
            <li><strong>Váltó:</strong> {{ $car->valto }}</li>
            <li><strong>Szín:</strong> {{ $car->szin }}</li>
            <li><strong>Karosszéria:</strong> {{ $car->karosszeria }}</li>
          </ul>
          <div class="text-muted small">
            <i class="fas fa-user"></i> Hirdető: {{ $car->user->username ?? 'Ismeretlen' }}
          </div>
        </div>
      </div>
      <a href="{{ route('cars.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Vissza a listához</a>
    </div>
  </div>
</div>
@endsection
