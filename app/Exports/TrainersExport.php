<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TrainersExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(private EloquentBuilder $query) {}

    public function query(): QueryBuilder|EloquentBuilder|Relation
    {
        return $this->query;
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Apellido'];
    }

    public function map($trainer): array
    {
        return [$trainer->id, $trainer->nombre, $trainer->apellido];
    }
}