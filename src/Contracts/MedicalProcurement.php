<?php

namespace Zahzah\ModuleMedicalProcurement\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Zahzah\ModuleProcurement\Contracts\Procurement;

interface MedicalProcurement extends Procurement {
    public function getMedicalProcurement(): mixed;
    public function prepareShowMedicalProcurement(? Model $model = null, ? array $attributes = null): Model;
    public function showMedicalProcurement(? Model $model = null): array;
    public function prepareMedicalStoreProcurement(mixed $attributes = null): Model;
    public function storeMedicalProcurement(): array;
    public function prepareMedicalProcurementPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator;
    public function viewMedicalProcurementPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array;
    public function medicalProcurement(mixed $conditionals = null): Builder;
}
