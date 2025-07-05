<?php

namespace App\Http\Controllers;

use App\Models\Traveller;
use Illuminate\Http\Request;

class TravellerController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        $travellers = Traveller::where('passport_no', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($travellers);
    }
}
