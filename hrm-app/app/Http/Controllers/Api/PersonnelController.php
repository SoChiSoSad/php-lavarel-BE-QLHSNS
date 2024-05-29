<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnel = User::role('personnel')->get(); 
        return response()->json($personnel);
    }
}
