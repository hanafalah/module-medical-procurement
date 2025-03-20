<?php

namespace Hanafalah\ModuleMedicalProcurement\Schemas;

use Hanafalah\ModuleMedicalProcurement\Contracts\{
    MedicalProcurement as ContractsMedicalProcurement
};
use Hanafalah\ModuleMedicalProcurement\Resources\MedicalProcurement\ShowMedicalProcurement;
use Hanafalah\ModuleMedicalProcurement\Resources\MedicalProcurement\ViewMedicalProcurement;
use Hanafalah\ModuleProcurement\Schemas\Procurement;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MedicalProcurement extends Procurement implements ContractsMedicalProcurement
{
    protected string $__entity = 'MedicalProcurement';
    public static $medical_procurement_model;

    protected array $__resources = [
        'view' => ViewMedicalProcurement::class,
        'show' => ShowMedicalProcurement::class
    ];

    public function getMedicalProcurement(): mixed
    {
        return static::$medical_procurement_model;
    }

    public function prepareShowMedicalProcurement(?Model $model = null, ?array $attributes = null): Model
    {
        $attributes ??= request()->all();

        $model ??= $this->getMedicalProcurement();
        if (!isset($model)) {
            $id = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('id not found');

            $model = $this->medicalProcurement()->with($this->showUsingRelation())->findOrFail($id);
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$medical_procurement_model = $model;
    }

    public function showMedicalProcurement(?Model $model = null): array
    {
        return $this->transforming($this->__resources['show'], function () use ($model) {
            return $this->prepareShowMedicalProcurement($model);
        });
    }

    public function prepareMedicalStoreProcurement(mixed $attributes = null): Model
    {
        $attributes ??= request()->all();
        $attributes['morphs'] = $this->MedicalProcurementModel()->getMorphClass();
        $procurement = $this->prepareStoreProcurement($attributes);
        return static::$medical_procurement_model = $procurement;
    }

    public function storeMedicalProcurement(): array
    {
        return $this->transaction(function () {
            return $this->showMedicalProcurement($this->prepareMedicalStoreProcurement());
        });
    }

    public function prepareMedicalProcurementPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');

        $model = $this->medicalProcurement()->paginate(...$this->arrayValues($paginate_options));

        return static::$medical_procurement_model = $model;
    }

    public function viewMedicalProcurementPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        $p = $this->ProcurementModel()->first();
        return $this->transforming($this->__resources['view'], function () use ($paginate_options) {
            return $this->prepareMedicalProcurementPaginate(...$this->arrayValues($paginate_options));
        }, [
            'rows_per_page' => [50]
        ]);
    }

    public function medicalProcurement(mixed $conditionals = null): Builder
    {
        $this->booting();
        return $this->MedicalProcurementModel()->with(['transaction', 'author'])
            ->conditionals($conditionals)->withParameters()->orderBy('created_at', 'desc');
    }
}
