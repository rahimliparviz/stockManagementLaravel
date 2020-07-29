<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Regulations;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
    public function regulations(){
        $regulations = Regulations::first();
        return response()->json($regulations);
    }
}
