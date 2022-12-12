<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;

class InvestmentController extends Controller
{

    public function index()
    { 
        $investments = Investment::orderBy('created_at', 'DESC') 
                                    ->get(); 

        return view('v1.admin.investments', compact('investments'));
    }


}
