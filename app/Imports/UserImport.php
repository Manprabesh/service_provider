<?php
namespace App\Imports;
use Illuminate\Support\Collection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Service;

class UserImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $row)
    {
        dd($row);
        $data=[];
        for($i=0;$i<count($row);$i++){
            $data[]=[
                'name'=>$row[$i]['name']
            ];
             Service::create([
            'name'=>$row[$i]['name'],
            'email'=>$row[$i]['email'],
            'service_name'=>$row[$i]['service_name'],
            'price'=>$row[$i]['price'], 
            'location'=>$row[$i]['location']
             ]);
        }


    }

}
