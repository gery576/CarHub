<?php

// app/Http/Controllers/CarController.php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // Middleware-t most nem használok, majd később lehet visszateszem

    public function show(Car $car)
    {
        // Itt csak egy autót mutatunk meg
        return view('cars.show', ['car' => $car]);
    }

    public function index(Request $request)
    {
        $query = Car::query();

        // Szűrés gyártóra
        if ($request->has('marka') && $request->marka != '') {
            $query->where('marka', $request->marka);
        }
        // Modell szűrés
        if ($request->has('modell') && $request->modell != '') {
            $query->where('modell', 'like', '%' . $request->modell . '%');
        }
        // Évjárat szűrés
        if ($request->has('evjarat_tol') && $request->evjarat_tol != '') {
            $query->where('evjarat', '>=', $request->evjarat_tol);
        }
        if ($request->has('evjarat_ig') && $request->evjarat_ig != '') {
            $query->where('evjarat', '<=', $request->evjarat_ig);
        }
        // Ár szűrés
        if ($request->has('ar_tol') && $request->ar_tol != '') {
            $query->where('ar', '>=', $request->ar_tol);
        }
        if ($request->has('ar_ig') && $request->ar_ig != '') {
            $query->where('ar', '<=', $request->ar_ig);
        }
        // Km óra szűrés
        if ($request->has('km_ora_tol') && $request->km_ora_tol != '') {
            $query->where('km_ora', '>=', $request->km_ora_tol);
        }
        if ($request->has('km_ora_ig') && $request->km_ora_ig != '') {
            $query->where('km_ora', '<=', $request->km_ora_ig);
        }
        // Teljesítmény szűrés
        if ($request->has('teljesitmeny_tol') && $request->teljesitmeny_tol != '') {
            $query->where('teljesitmeny', '>=', $request->teljesitmeny_tol);
        }
        if ($request->has('teljesitmeny_ig') && $request->teljesitmeny_ig != '') {
            $query->where('teljesitmeny', '<=', $request->teljesitmeny_ig);
        }
        // Váltó szűrés
        if ($request->has('valto') && $request->valto != '') {
            $query->where('valto', $request->valto);
        }
        // Szín szűrés
        if ($request->has('szin') && $request->szin != '') {
            $query->where('szin', $request->szin);
        }
        // Karosszéria szűrés
        if ($request->has('karosszeria') && $request->karosszeria != '') {
            $query->where('karosszeria', $request->karosszeria);
        }
        // Üzemanyag szűrés
        if ($request->has('uzemanyag') && $request->uzemanyag != '') {
            $query->where('uzemanyag', $request->uzemanyag);
        }

        $cars = $query->orderBy('created_at', 'desc')->paginate(9);

        // Itt visszaadjuk a nézetet
        return view('cars.index', ['cars' => $cars]);
    }

    public function create()
    {
        // Üzemanyag típusok listája
        $uzemanyagTipusok = ['benzin', 'gázolaj', 'hibrid', 'elektromos', 'gázüzemű'];
        return view('cars.create', ['uzemanyagTipusok' => $uzemanyagTipusok]);
    }

    public function store(Request $request)
    {
        // Validáció
        $request->validate([
            'marka'      => 'required',
            'modell'     => 'required',
            'evjarat'    => 'required|integer|min:1900|max:' . date('Y'),
            'ar'         => 'required|integer|min:100000',
            'leiras'     => 'required|min:10',
            'uzemanyag'  => 'required',
            'images.*'   => 'image|max:2048'
        ],[
            'marka.required' => 'A gyártó mező kötelező!',
            'modell.required' => 'A modell mező kötelező!',
            'evjarat.required' => 'Az évjárat mező kötelező!',
            'ar.required' => 'Az ár mező kötelező!',
            'leiras.required' => 'A leírás mező kötelező!',
            'uzemanyag.required' => 'Az üzemanyag mező kötelező!',
            'leiras.min' => 'Legalább 10 karakter!',
            'ar.min' => 'Minimum 100 000 Ft!',
            'images.*.image' => 'Csak kép lehet!',
            'images.*.max' => 'Max 2 MB!'
        ]);

        // Extrák mentése
        $extrak = '';
        if ($request->has('extrak')) {
            $extrak = implode(',', $request->extrak);
        }

        // Autó mentése
        $car = new Car();
        $car->user_id = Auth::id();
        $car->marka = $request->marka;
        $car->modell = $request->modell;
        $car->evjarat = $request->evjarat;
        $car->ar = $request->ar;
        $car->leiras = $request->leiras;
        $car->uzemanyag = $request->uzemanyag;
        $car->km_ora = $request->km_ora;
        $car->teljesitmeny = $request->teljesitmeny;
        $car->valto = $request->valto;
        $car->szin = $request->szin;
        $car->karosszeria = $request->karosszeria;
        $car->extrak = $extrak;
        $car->kep = null;
        $car->save();

        // Képek mentése
        if ($request->hasFile('images')) {
            $i = 0;
            foreach ($request->file('images') as $kep) {
                $path = $kep->store('cars', 'public');
                $filename = basename($path);

                if ($i == 0) {
                    $car->kep = $filename;
                    $car->save();
                }
                $car->images()->create(['path' => $filename]);
                $i++;
            }
        }

        return view('success', ['message' => 'Autóhirdetés és képek feltöltve!']);
    }
}

