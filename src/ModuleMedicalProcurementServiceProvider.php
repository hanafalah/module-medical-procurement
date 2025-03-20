<?php

namespace Hanafalah\ModuleMedicalProcurement;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModuleMedicalProcurementServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMainClass(ModuleMedicalProcurement::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*',
                'Services'  => function () {
                    $this->binds([
                        Contracts\MedicalProcurement::class  => Schemas\MedicalProcurement::class,
                    ]);
                },
            ]);
    }

    protected function dir(): string
    {
        return __DIR__ . '/';
    }

    protected function migrationPath(string $path = ''): string
    {
        return database_path($path);
    }
}
