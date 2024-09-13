<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware('auth');
        $this->users = User::where('is_active', true)->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('users.users', [
            'users' => $this->users,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|integer',
            'password' => 'required|string|max:255',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();

        return redirect(route('users.index'))->with('success', __('messages.add_user_message'));
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|integer',
        ]);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect(route('users.index'))->with('success', __('messages.update_user_message'));
    }

    public function destroy(User $user)
    {
        $user->update([
            'is_active' => false,
        ]);

        return redirect(route('users.index'))->with('success', __('messages.delete_user_message'));
    }
}
