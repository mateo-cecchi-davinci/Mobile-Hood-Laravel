<?php

namespace App\Http\Controllers;

use App\Models\Buisness;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuisnessController extends Controller
{
    protected $buisnesses;
    protected $users;

    public function __construct()
    {
        $this->middleware('auth');
        $this->buisnesses = Buisness::where('is_active', true)->get();
        $this->users = User::where('is_active', true)->get();
    }

    public function index()
    {
        return view('buisnesses.buisnesses', [
            'buisnesses' => $this->buisnesses
        ]);
    }

    public function create()
    {
        return view('buisnesses.create', [
            'users' => $this->users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,png,jpeg,webp',
            'street' => 'required|string|max:255',
            'number' => 'required|integer',
            'users' => 'required|array|min:0|max:1',
            'categories' => 'required|array|min:0|max:1',
        ]);

        $buisness = new Buisness();

        $buisness->name = $request->name;
        $imagePath = $request->file('logo')->store('logos', 'public');
        $buisness->logo = $imagePath;
        $buisness->street = $request->street;
        $buisness->number = $request->number;
        $buisness->fk_buisnesses_users = $request->users[0];
        $buisness->category = $request->categories[0];

        $buisness->save();

        return redirect(route('buisnesses.index'))->with('success', __('messages.add_buisness_message'));
    }

    public function show(Buisness $buisness)
    {
        return view('buisnesses.show', [
            'buisness' => $buisness,
        ]);
    }

    public function edit(Buisness $buisness)
    {
        $categories = [
            'butcher_shop',
            'grocery_store',
            'winery',
        ];

        return view('buisnesses.edit', [
            'users' => $this->users,
            'buisness' => $buisness,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Buisness $buisness)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,png,jpeg,webp',
            'street' => 'required|string|max:255',
            'number' => 'required|integer',
            'users' => 'required|array|min:0|max:1',
            'categories' => 'required|array|min:0|max:1',
        ]);

        $buisness->name = $request->name;

        if ($request->has('logo')) {
            $imagePath = $request->file('logo')->store('logos', 'public');

            if ($buisness->logo) {
                Storage::disk('public')->delete($buisness->logo);
            }

            $buisness->logo = $imagePath;
        }

        $buisness->street = $request->street;
        $buisness->number = $request->number;
        $buisness->fk_buisnesses_users = $request->users[0];
        $buisness->category = $request->categories[0];

        $buisness->save();

        return redirect(route('buisnesses.index'))->with('success', __('messages.update_buisness_message'));
    }

    public function destroy(Buisness $buisness)
    {
        $buisness->update([
            'is_active' => false,
        ]);

        return redirect(route('buisnesses.index'))->with('success', __('messages.delete_buisness_message'));
    }
}
