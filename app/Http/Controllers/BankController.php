<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        $banks = Bank::where('branch_name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($banks);
    }
}
