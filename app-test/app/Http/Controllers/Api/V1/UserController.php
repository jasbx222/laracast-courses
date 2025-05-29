<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\API\V1\UpdateTicketRequest;
use App\Http\Requests\API\V1\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traites\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponse;
    public function login(UserRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::where('email', $validated['email'])->first();

        $tokenName = 'API Token for ' . $user->email;

        $token = $user->createToken($tokenName)->plainTextToken;

        return $this->success('Authenticated', ['token' => $token]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $tokenName = 'API Token for ' . $user->email;

        $token = $user->createToken($tokenName)->plainTextToken;

        return $this->success('User registered successfully', ['token' => $token]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $user = User::find($id);

    //     if (!$user) {
    //         return $this->user_not_found(
    //             'user is not found',
    //             404
    //         );
    //     }

    //     $tickets = $user->tickets; // Assuming a relation 'tickets' exists in User model

    //     return response()->json($tickets);
    // }

public function show(Request $req, $id){
    $userOne = User::find($id);
    return  new UserResource($userOne);
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  UserResource::collection(User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
        return response()->json('logout done !', 200);
    }
}
