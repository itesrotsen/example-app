<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|View
    {
        $role = Auth::user()->roles()->first();
        $hasContactViewPermission = $role->hasPermissionTo('contact.view');
        return view('welcome');
    }

}
