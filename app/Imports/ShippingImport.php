<?php

namespace App\Imports;

use App\Models\Shipping;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShippingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ini_set('max_execution_time', '500');

        $ShippingCount = Shipping::where("ps_pincode", $row['pincode'])->count();
        if($ShippingCount == 0){
            return new Shipping([
                'ps_pincode' => $row['pincode']
            ]);
        }
    }
}
