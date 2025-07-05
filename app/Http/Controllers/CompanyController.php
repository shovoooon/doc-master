<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        $companies = Company::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($companies);
    }
}
