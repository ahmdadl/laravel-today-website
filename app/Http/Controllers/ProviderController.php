<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    protected array $rules = [
        'name' => 'required|string|min:3|max:50',
        'email' => 'required|email|unique:users,email',
        'avatar' => 'sometimes|url',
        'profile' => 'sometimes|url',
        'title' => 'required|string|min:3|max:50|unique:providers,title',
        'home_url' => 'required|url',
        'req_url' => 'required|url|unique:providers,request_url',
        'bio' => 'sometimes|min:10|max:140',
    ];

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
        $res = (object) request()->validate($this->rules);

        $user = User::create([
            'name' => $res->name,
            'email' => $res->email,
            'image' => $res->avatar,
            'url' => $res->profile,
            'password' => Hash::make(bin2hex(random_bytes(8))),
        ]);

        $user->provider()->create([
            'title' => strtolower($res->title),
            'url' => $res->home_url,
            'request_url' => $res->req_url,
            'bio' => $res->bio,
        ]);

        return view('provider.created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    public function checkState(Request $request)
    {
        if ($request->wantsJson()) {
            $res = (object) request()->validate([
                'title' => 'required|string|min:3|max:50',
                'req_url' => 'required|url',
            ]);

            $res->title = strtolower($res->title);

            $provider = Provider::whereRaw('LOWER(title) like ? ')
                ->addBinding("%{$res->title}%")
                ->whereRequestUrl($res->req_url)
                ->first();

            if (null === $provider) {
                return response()->noContent();
            }

            return response()->json(['status' => $provider->state]);
        }

        return view('provider.check');
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
