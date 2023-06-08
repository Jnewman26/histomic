<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\LibraryReader;
use App\Models\LibraryWriter;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SignupController extends Controller
{
    public function create()
    {
        return Inertia::render('Application/Signup', []);
    }

    public function store(Request $request)
    {
        $request->validate([
            'USER_NAME' => 'required',
            'USER_EMAIL' => 'required|unique:user|email',
            'USER_PHONE' => 'required|unique:user|min:10',
            'USER_GENDER' => 'required',
            'USER_PASSWORD' => 'required|min:8'
        ], [
            'USER_NAME.required' => 'The Full Name field is required.',
            'USER_EMAIL.required' => 'The Email field is required.',
            'USER_EMAIL.unique' => 'The Email has already been taken.',
            'USER_EMAIL.email' => 'The Email field must be a valid email address.',
            'USER_PHONE.required' => 'The Phone Number field is required.',
            'USER_PHONE.unique' => 'The Phone Number has already been taken.',
            'USER_PHONE.min' => 'The Phone Number field must be at least 10 characters.',
            'USER_GENDER.required' => 'The Gender field is required.',
            'USER_PASSWORD.required' => 'The Password field is required.',
            'USER_PASSWORD.min' => 'The Password field must be at least 8 characters.'
        ]);

        $userName = $request->input('USER_NAME');
        $firstName = strtoupper(substr($userName, 0, 1));
        $currentDate = now()->format('Y-m-d');
        $status = 1;
        $verifiedDate = now();
        $joinDate = now();

        // user id
        $userId = DB::selectOne('SELECT generate_user_id(?, ?) AS user_id', [$firstName, $currentDate])->user_id;
        // cart id
        $cartId = DB::selectOne('SELECT generate_cart_id(?, ?) AS cart_id', [$firstName, $currentDate])->cart_id;
        // libw id
        $libwId = DB::selectOne('SELECT generate_libw_id(?, ?) AS library_writer_id', [$firstName, $currentDate])->library_writer_id;
        // libr id
        $librId = DB::selectOne('SELECT generate_libr_id(?, ?) AS library_reader_id', [$firstName, $currentDate])->library_reader_id;
        //wish id
        $wishId = DB::selectOne('SELECT generate_wish_id(?, ?) AS wishlist_id', [$firstName, $currentDate])->wishlist_id;

        // tabel user
        $post = $request->all();
        $post['USER_ID'] = $userId;
        $post['CART_ID'] = $cartId;
        $post['LIBRARY_WRITER_ID'] = $libwId;
        $post['LIBRARY_READER_ID'] = $librId;
        $post['WISHLIST_ID'] = $wishId;
        $post['USER_VERIFIED_AT'] = $verifiedDate;
        $post['USER_STATUS'] = $status;
        $post['USER_JOIN_DATE'] = $joinDate;
        $post['USER_PASSWORD'] = Hash::make($request->input('USER_PASSWORD'));
        User::create($post);

        // tabel cart
        $post = $request->all();
        $post['USER_ID'] = $userId;
        $post['CART_ID'] = $cartId;
        Cart::create($post);

        // tabel wishlist
        $post = $request->all();
        $post['USER_ID'] = $userId;
        $post['WISHLIST_ID'] = $wishId;
        Wishlist::create($post);

        // tabel library_reader
        $post = $request->all();
        $post['USER_ID'] = $userId;
        $post['LIBRARY_READER_ID'] = $librId;
        LibraryReader::create($post);

        // tabel library_writer
        $post = $request->all();
        $post['USER_ID'] = $userId;
        $post['LIBRARY_WRITER_ID'] = $libwId;
        LibraryWriter::create($post);

        return Redirect::route('login')->with('message', 'Pengguna berhasil dibuat.');
    }
}
