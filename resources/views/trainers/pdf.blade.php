<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #444; padding: 5px; text-align: left; vertical-align: middle; }
        th { background: #eee; }
        .foto { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; }
        .sin-foto { color: #888; font-size: 10px; }
    </style>
</head>
<body>
    <h2>Informe de trainers</h2>
    <p>Generado: {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr><th width="70">Foto</th><th>ID</th><th>Nombre</th><th>Apellido</th></tr>
        </thead>
        <tbody>
            @foreach($trainers as $t)
            <tr>
                <td>
                    @if($t->foto && file_exists(public_path('storage/'.$t->foto)))
                        <img src="{{ public_path('storage/'.$t->foto) }}" class="foto">
                    @else
                        <span class="sin-foto">Sin foto</span>
                    @endif
                </td>
                <td>{{ $t->id }}</td>
                <td>{{ $t->nombre }}</td>
                <td>{{ $t->apellido }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>