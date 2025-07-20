<?php
namespace App\Imports;
use Illuminate\Support\Collection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Providers;
use Illuminate\Support\Facades\Log;

class UserImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $row)
    {
        // dd(count($row));
        
        // $data = [];
        for ($i = 0; $i < count($row); $i++) {
            $providers = new Providers;
            $data[] = [
                'name' => $row[$i]['name']
            ];
            Log::info("name ->",$data);
      
            $providers->name = $row[$i]['name'];
            $providers->email = $row[$i]['email'];
            $providers->DOB = $row[$i]['dob'];
            $providers->pincode = $row[$i]['pincode'];
            $providers->price = $row[$i]['price'];
            $providers->review = $row[$i]['review'];
            $providers->service_type = $row[$i]['service_type'];
            $providers->adhar_no = $row[$i]['adhar_no'];
            $providers->pan_no = $row[$i]['pan_no'];
            $providers->phone = $row[$i]['phone'];
            $providers->distric = $row[$i]['distric'];
            $providers->nationality = $row[$i]['nationality'];
            $providers->experience = $row[$i]['experience'];
            $providers->about = $row[$i]['about'];
            $providers->town = $row[$i]['town'];
            $providers->save();
            
        }


    }

}
