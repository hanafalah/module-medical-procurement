<?php

namespace Zahzah\ModuleMedicalProcurement\Models\Procurement;

use Zahzah\ModuleProcurement\Models\Procurement;

class MedicalProcurement extends Procurement
{
    protected $table = 'procurements';

    protected static function booted(): void{
        parent::booted();
        static::creating(function($query){
            if (!isset($query->medical_procurement_code)) {
                $query->medical_procurement_code = static::hasEncoding('MEDICAL_PROCUREMENT'); 
            }
        });
    }
}
