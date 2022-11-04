<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
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
     * @return JsonResponse
     */
    public function index()
    {
//        $users = User::
        return response()->json([
            'response'  =>  [
                'message'   =>  'success',
                'data'  =>  User::readers()->get(),
            ],
        ]);
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
        $user->birth_date = Carbon::create($valid['birth_date']);
        $user->save();
        return response()->json([
            'response'  =>   [
                'message'   =>  'success',
                'id'  =>  $user->id,
                'name'  =>  $user->name,
                'email'  =>  $user->email,
            ],
        ],200);
    }

    public function auth(UserAuthRequest $request)
    {
        $valid = $request->validated();
        $user = User::where('email', $valid['email'])->first();
        if ($user && Hash::check($valid['password'],$user->password)) {
            $user->remember_token = Str::random(100);
            $user->save();
            return response()->json([
                'Bearer'    =>  $user->remember_token,
                'id'    =>  $user->id,
                'name'    =>  $user->name,
                'email'    =>  $user->email,
            ], 200);
        } else {
            return response()->json([
                'Bearer'    =>  'error',
                'id'    =>  'error',
                'name'    =>  'error',
                'email'    =>  'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'message'   =>  'success',
            'reponse'   =>   $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        $valid = $request->validated();
        $user = User::find($id);
        $user->update($valid);
        $user->save();
        return response()->json([
            'message'   =>  'success',
            'response'  =>   $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'response'  =>  [
                'message'   =>  'success',
            ],
        ]);
    }
}
