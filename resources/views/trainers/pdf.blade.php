<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #444; padding: 5px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Informe de trainers</h2>
    <p>Generado: {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th></tr></thead>
        <tbody>
            @foreach($trainers as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->nombre }}</td>
                <td>{{ $t->apellido }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>