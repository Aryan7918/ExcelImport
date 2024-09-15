<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HolidaysImport;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HolidayController extends Controller
{
    public function index()
    {
        return view('holidays');
    }
    public function preImport(Request $request)
    {
        // Validate that the file is an Excel file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Load the Excel file
        $file = $request->file('file');

        // Load the data using ToCollection to preview
        $rows = Excel::toCollection(new HolidaysImport, $file)->first();

        // Return the rows to the frontend as a JSON response
        return response()->json($rows);
    }

    public function import(Request $request)
    {
        // Validate that the file is an Excel file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Import the data into the database
        Excel::import(new HolidaysImport, $request->file('file'));

        return response()->json(['success' => 'Data Imported Successfully']);
    }
}
