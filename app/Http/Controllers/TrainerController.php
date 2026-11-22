<?php

namespace App\Http\Controllers;

use App\Exports\TrainersExport;
use App\Models\Trainer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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

    private function validar(Request $request): array
    {
        return $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'nullable|string|max:100',
        ]);
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
        Trainer::create($this->validar($request));
        return redirect()->route('trainers.index')->with('ok', 'Trainer creado correctamente');
    }

    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $trainer->update($this->validar($request));
        return redirect()->route('trainers.index')->with('ok', 'Trainer actualizado correctamente');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();
        return redirect()->route('trainers.index')->with('ok', 'Trainer eliminado correctamente');
    }

    public function exportPdf(Request $request)
    {
        $trainers = $this->consulta($request)->get();
        return Pdf::loadView('trainers.pdf', compact('trainers'))->download('trainers.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new TrainersExport($this->consulta($request)), 'trainers.xlsx');
    }
}