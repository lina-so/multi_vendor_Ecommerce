<?php

namespace App\Http\Controllers\Front\Wishlist;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Services\WishlistService;
use App\Services\SoftDeleteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public $wishlistService,$softDeleteService;
    public function __construct(WishlistService $wishlistService , SoftDeleteService $softDeleteService )
    {
        $this->wishlistService = $wishlistService;
        $this->softDeleteService = $softDeleteService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->wishlistService->index();

        return view('layouts.front.sections.wishlist',compact('data'));
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
    public function store(Request $request,$id)
    {
        $wishlist = $this->wishlistService->storeItem($id);
        return response()->json($wishlist);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::where('wishlistable_id',$id)->where('user_id',Auth::user()->id)->first();
        $wishlist->delete();
        return response()->json($wishlist);

    }
}
