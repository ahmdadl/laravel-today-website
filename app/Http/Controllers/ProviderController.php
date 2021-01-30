<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = (object) request()->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'sometimes|url',
            'profile' => 'sometimes|url',
            'title' => 'required|string|min:3|max:50|unique:providers,title',
            'home_url' => 'required|url',
            'req_url' => 'required|url',
            'bio' => 'sometimes|min:10|max:140',
        ]);

        $user = User::create([
            'name' => $res->name,
            'email' => $res->email,
            'image' => $res->avatar,
            'url' => $res->profile,
            'password' => Hash::make(bin2hex(random_bytes(8))),
        ]);

        $provider = $user
            ->provider()
            ->create([
                'title' => $res->title,
                'url' => $res->home_url,
                'request_url' => $res->req_url,
                'bio' => $res->bio,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
