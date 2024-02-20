<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationStoreRequest;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $applications = $user->applications;
        return view('user.application.index', compact('user', 'applications'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('user.application.store', compact('user'));
    }

    public function store(ApplicationStoreRequest $request)
    {
        $user = Auth::user();
        Application::create([
            'user_id' => $user->id
        ] + $request->all());
        return redirect()->back()->with('success', 'Заявка успешно создана');
    }
}
