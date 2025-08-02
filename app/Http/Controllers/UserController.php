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

    public function export()
    {
        return Excel::download(new UserExport, 'providers.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        Excel::import(new UserImport, $request->file('file'));
        return back()->with('success', 'Users imported successfully.');
    }
}
