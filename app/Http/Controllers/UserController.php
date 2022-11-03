<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $valid = $request->validated();
        $user = User::create($valid);
        $user->remember_token = Str::random(100);
        $user->save();
        return response()->json([
            'Bearer'    =>  $user->remember_token,
        ],200);
    }

    public function auth(UserAuthRequest $request)
    {
        $valid = $request->validated();
        $user = User::where('email', $valid['email'])
            ->first();
        if ($user && Hash::check($valid['password'],$user->password)) {
            $user->remember_token = Str::random(100);
            $user->save();
            return response()->json([
                'Bearer'    =>  $user->remember_token,
            ], 200);
        } else {
            return response()->json([
                'Bearer'    =>  'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
