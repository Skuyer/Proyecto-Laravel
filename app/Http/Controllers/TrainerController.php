<?php

namespace App\Http\Controllers;

use App\Exports\TrainersExport;
use App\Models\Trainer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TrainerController extends Controller
{
    // Consulta compartida: la usan el listado y las exportaciones,
    // así el PDF/Excel respetan lo que se buscó.
    private function consulta(Request $request)
    {
        return Trainer::query()
            ->when($request->q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nombre', 'ilike', "%{$q}%")
                        ->orWhere('apellido', 'ilike', "%{$q}%");
                });
            })
            ->orderBy('id', 'desc');
    }

    public function index(Request $request)
    {
        $trainers = $this->consulta($request)->paginate(10)->withQueryString();
        return view('trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('trainers', 'public');
        }

        Trainer::create($data);
        return redirect()->route('trainers.index')->with('success', 'Trainer creado');
    }

    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($trainer->foto) {
                Storage::disk('public')->delete($trainer->foto); // borra la anterior
            }
            $data['foto'] = $request->file('foto')->store('trainers', 'public');
        }

        $trainer->update($data);
        return redirect()->route('trainers.index')->with('success', 'Trainer actualizado');
    }

    public function destroy(Trainer $trainer)
    {
        if ($trainer->foto) {
            Storage::disk('public')->delete($trainer->foto);
        }
        $trainer->delete();
        return redirect()->route('trainers.index');
    }

    public function pdf(Request $request)
    {
        $trainers = $this->consulta($request)->get();
        return Pdf::loadView('trainers.pdf', compact('trainers'))->download('trainers.pdf');
    }

    public function excel(Request $request)
    {
        return Excel::download(new TrainersExport($this->consulta($request)), 'trainers.xlsx');
    }
}