<?php

namespace App\Exports;

// use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Providers;
// use App\Invoice;
class UserExport implements FromCollection
{
   
    public function collection()
    {
        return Providers::all();
    }

   
}
