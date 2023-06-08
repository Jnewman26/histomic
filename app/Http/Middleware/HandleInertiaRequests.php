<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'auth' => $request->user() ? [
                'USER_ID' => $request->user()->USER_ID,
                'CART_ID' => $request->user()->CART_ID,
                'LIBRARY_WRITER_ID' => $request->user()->LIBRARY_WRITER_ID,
                'WISHLIST_ID' => $request->user()->WISHLIST_ID,
                'LIBRARY_READER_ID' => $request->user()->LIBRARY_READER_ID,
                'USER_NAME' => $request->user()->USER_NAME,
                'USER_PHONE' => $request->user()->USER_PHONE,
                'USER_GENDER' => $request->user()->USER_GENDER,
                'USER_VERIFIED_AT'=>$request->user()->USER_VERIFIED_AT,
                'USER_PASSWORD' => $request->user()->USER_PASSWORD,
                'USER_STATUS' => $request->user()->USER_STATUS,
                'USER_JOIN_DATE' => $request->user()->USER_JOIN_DATE,
            ] : null
        ]);
    }
}
