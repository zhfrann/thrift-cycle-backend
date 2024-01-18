<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login()
    {
        // return redirect('/login');
        return response()->json('redirect ke /login');
    }

    public function authenticate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|max:255',
                'password' => 'required|max:255',
            ]);

            if (Auth::attempt($validatedData)) {
                $request->session()->regenerate();

                return redirect('/', 200);
            }

            return false;
        } catch (QueryException $e) {
            return response()->json($e);
        }
    }

    public function register()
    {
        return redirect('/register');
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'role' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if (User::create($validatedData)) {
            return redirect('/login', 201)->with('registerSuccess', 'Akun berhasil diregistrasikan');
        } else {
            return redirect('/register', 401)->with("registerFailed", "Akun gagal diregistrasikan");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
