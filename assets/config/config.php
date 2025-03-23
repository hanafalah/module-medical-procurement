<?php

use Hanafalah\ModuleMedicalProcurement\Models\Procurement\MedicalProcurement;
use Hanafalah\ModuleProcurement\Commands;

return [
    'commands' => [
        Commands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            'MedicalProcurement' => MedicalProcurement::class
        ]
    ],
];
