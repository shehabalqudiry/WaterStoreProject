<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectImport implements ToModel, WithHeadingRow
{
    public $city_id;
    public $type_id;
    public function __construct($city_id, $type_id = null)
    {
        $this->city_id = $city_id;
        $this->type_id = $type_id;
    }

    public function model(array $row)
    {
        // dd($row);
        return new Project([
            'unit_type'         => $row["noaa_alohd"],
            'city_id'           => $this->city_id,
            'type_id'           => $this->type_id,
            'floor'             => $row["aldor"],
            'statement'         => $row["albyan"],
            'location'          => $row["almokaa"],
            'rent_insurance'    => $row["tamyn_dkhol_alsfk"],
            'area'              => $row["almsah"],
            'rent'              => $row["alkym_alaygary_alshhry"],
            'sale_price'        => $row["saar_albyaa"],
        ]);
    }
}
