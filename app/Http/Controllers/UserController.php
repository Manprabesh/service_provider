<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
  
        return view('users', compact('users'));
    }
          
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UserExport, 'providers.xlsx');
    }
         
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        // dd($request);
        // Validate incoming request data
        $request->validate([
            'file' => 'required|max:2048',
        ]);
  
        // dd($request->file('file'));
        Excel::import(new UserImport, $request->file('file'));
                 
        return back()->with('success', 'Users imported successfully.');
    }

}
