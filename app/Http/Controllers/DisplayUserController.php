<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DisplayUserController extends Controller
{
    public function displayUser()
    {
        $users = User::where('id','>',0)->simplePaginate(1);

        return view('display1',compact('users'));
    }
}
