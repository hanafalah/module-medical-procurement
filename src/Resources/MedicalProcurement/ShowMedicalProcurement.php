<?php

namespace Zahzah\ModuleMedicalProcurement\Resources\MedicalProcurement;

use Zahzah\ModuleProcurement\Resources\Procurement\ShowProcurement;

class ShowMedicalProcurement extends ShowProcurement
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $arr = [
            'medical_procurement_code' => $this->medical_procurement_code
        ];

        $arr = $this->mergeArray(parent::toArray($request), $arr);
        
        return $arr;
    }
}
