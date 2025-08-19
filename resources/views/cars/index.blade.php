@extends('layout')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 text-center fw-bold">Autóhirdetések</h1>

  <!-- Kereső űrlap -->
  <form method="GET" action="{{ route('cars.index') }}" class="mb-4 bg-light p-4 rounded shadow-sm">
    <div class="row g-3">
      <div class="col-md-3">
        <input type="text" name="marka" class="form-control" placeholder="Gyártó" value="{{ request('marka') }}">
      </div>
      <div class="col-md-3">
        <input type="text" name="modell" class="form-control" placeholder="Modell" value="{{ request('modell') }}">
      </div>
      <div class="col-md-2">
        <input type="number" name="evjarat_tol" class="form-control" placeholder="Évjárat -tól" value="{{ request('evjarat_tol') }}">
      </div>
      <div class="col-md-2">
        <input type="number" name="evjarat_ig" class="form-control" placeholder="Évjárat -ig" value="{{ request('evjarat_ig') }}">
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">Szűrés</button>
      </div>
    </div>
  </form>

  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('cars.create') }}" class="btn btn-success px-4 py-2">
      <i class="fas fa-plus-circle"></i> Új hirdetés
    </a>
  </div>

  <div class="row">
    @forelse($cars as $car)
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100" style="transition:box-shadow 0.2s;">
          @if($car->kep)
            <img src="{{ asset('storage/cars/'.$car->kep) }}" class="card-img-top" alt="Autó képe" style="height:220px;object-fit:cover;">
          @else
            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:220px;">
              <span>Nincs kép</span>
            </div>
          @endif
          <div class="card-body">
            <h5 class="card-title fw-bold">{{ $car->marka }} {{ $car->modell }}</h5>
            <ul class="list-unstyled mb-2">
              <li><strong>Évjárat:</strong> {{ $car->evjarat }}</li>
              <li><strong>Üzemanyag:</strong> {{ ucfirst($car->uzemanyag) }}</li>
              <li><strong>Ár:</strong> <span class="text-success fs-5">{{ number_format($car->ar,0,',',' ') }} Ft</span></li>
            </ul>
            <a href="{{ route('cars.show',$car->id) }}" class="btn btn-outline-primary w-100">Részletek</a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-warning text-center">Nincs találat a keresési feltételek alapján.</div>
      </div>
    @endforelse
  </div>
  <div class="d-flex justify-content-center mt-4">
    {{ $cars->links() }}
  </div>
</div>
@endsection
