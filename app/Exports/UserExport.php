<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\servieModel;
// use App\Invoice;
class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return servieModel::select("name","email","service_name")->get();
    }

    // public function heading():array
    // {
    //     return ["ID","Name","Email"];
    // }
}
