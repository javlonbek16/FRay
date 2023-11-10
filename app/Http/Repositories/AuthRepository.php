<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\RegisterRequest;
use App\Models\Artist;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;


class  AuthRepository implements AuthInterface
{
    protected $user;
    protected $artist;
    protected $venue;

    public function __construct(User $user, Artist $artist, Venue $venue)
    {
        $this->user = $user;
        $this->artist = $artist;
        $this->venue = $venue;
    }

    public function register(RegisterRequest $request)
    {

        try {
            DB::beginTransaction();

            $username = $request->input('username');
            $password = $request->input('password');
            $roleType = $request->input('role_type');

            $user = User::create([
                'username' => $username,
                'password' => bcrypt($password),
                'role_type' => $roleType,
            ]);

            if ($roleType === 'artist') {
                $artist_name = $request->input('artist_name');

                $artist = Artist::create([
                    'user_id' => $user->id,
                    'artist_name' =>  $artist_name,
                    'city_state' => $request->input('city_state'),
                    'phone' => $request->input('phone'),
                    'genres_id' => $request->input('genres_id'),
                    'facebook_link' => $request->input('facebook_link'),
                    'image' => $request->file('image')->store('upload', 'public'),
                    'website_link' => $request->input('website_link'),
                    'looking_for_concert' => $request->input('looking_for_concert'),
                ]);
            } elseif ($roleType === 'venue') {

                $venueName = $request->input('venue_name');
                $address = $request->input('address');

                $venue = Venue::create([
                    'user_id' => $user->id,
                    'venue_name' => $venueName,
                    'city_state' => $request->input('city_state'),
                    'address' =>  $address,
                    'phone' => $request->input('phone'),
                    'genres_id' => $request->input('genres_id'),
                    'facebook_link' => $request->input('facebook_link'),
                    'image' => $request->file('image')->store('upload/register', 'public'),
                    'website_link' => $request->input('website_link'),
                    'looking_for_concert' => $request->input('looking_for_concert'),
                ]);
            } else {
                return response()->json(['error' => 'Invalid role type'], 400);
            }

            DB::commit();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(['message' => 'User registered successfully', 'token' => $token]);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = [
            'username' => $request['username'],
            'password' => $request['password']
        ];

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(['token' => $token]);
        }
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
