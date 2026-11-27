<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        return response('OK', 200);
    }
}