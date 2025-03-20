<?php

use Hanafalah\ModuleMedicalProcurement\Models\Procurement\MedicalProcurement;
use Hanafalah\ModuleProcurement\Commands;

return [
    'commands' => [
        Commands\InstallMakeCommand::class
    ],
    'database' => [
        'models' => [
            'MedicalProcurement' => MedicalProcurement::class
        ]
    ],
];
