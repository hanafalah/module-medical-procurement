<?php

use Zahzah\ModuleMedicalProcurement\Models\Procurement\MedicalProcurement;
use Zahzah\ModuleProcurement\Commands;

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
