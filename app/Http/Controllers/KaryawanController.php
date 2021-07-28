<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Create karyawan Form
    public function createForm(Request $request) 
    {
        return view('karyawan');
    }

     // Store karyawan Form data
     public function KaryawanForm(Request $request) {

        // Form validation
        $this->validate($request, [
            'nama' => 'required',
            'ktp' => 'required'
         ]);

        //  Store data in database
        Karyawan::create($request->all());

        // 
        return back()->with('success', 'Terimakasih telah mendaftar.');
    }
}
