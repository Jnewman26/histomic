<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Comic;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CustAdminController extends Controller
{
    public function signin()
    {
        return Inertia::render('Admin/SignIn');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin';
        $totalUsers = User::count();
        $sales = Sales::count();
        $comic = Comic::count();
        $totalUsersActive = User::where('USER_STATUS', 1)->count();
        $totalUsersNonActive = User::where('USER_STATUS', 0)->count();
        return Inertia::render('Admin/Index', [
            'pageTitle' => $title,
            'totalUsers' => $totalUsers,
            'totalUsersActive' => $totalUsersActive,
            'totalUsersNonActive' => $totalUsersNonActive,
            'sales' => $sales,
            'comic' => $comic,
            'activePage' => 'admin', // Pass the active page information here
        ]);
    }

    // Menampilkan daftar user
    public function user()
    {
        $title = 'User';
        $users = User::orderBy('USER_JOIN_DATE', 'DESC')->get();
        return Inertia::render('Admin/User', [
            'pageTitle' => $title,
            'users' => $users,
            'activePage' => 'user', // Pass the active page information here
        ]);
    }

    // Menampilkan daftar comic
    public function comic()
    {
        $title = 'Comic';
        $results = Comic::join('user', 'comic.LIBRARY_WRITER_ID', '=', 'user.LIBRARY_WRITER_ID')
            ->select('comic.*', 'user.USER_NAME')
            ->get();

        return Inertia::render('Admin/Comic', [
            'pageTitle' => $title,
            'results' => $results,
            'activePage' => 'comic', // Pass the active page information here
        ]);
    }

    // Menampilkan daftar admin
    public function admin()
    {
        $title = 'Admin';
        $users = Admin::orderBy('ADMIN_ID', 'ASC')->get();
        return Inertia::render('Admin/Admin', [
            'pageTitle' => $title,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $USER_ID)
    {
        return Inertia::render('Admin/Detail', [
            'user' => $USER_ID
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($USER_ID)
    {
        $user = User::find($USER_ID);
        return Inertia::render('Admin/Edit', [
            'user' => $user
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $USER_ID)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        User::where('USER_ID', $USER_ID)
            ->update([
                'USER_NAME' => $request->name,
                'USER_EMAIL' => $request->email,
                'USER_PHONE' => $request->phone,
                'USER_STATUS' => $request->status
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
