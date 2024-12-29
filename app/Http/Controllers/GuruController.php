<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(): Application|Factory|View
    {
        $guru = User::with('role')->where('id_role', '=', 2)->get();
        return view('guru.index', compact('guru'));
    }

    public function edit(User $user): Application|Factory|View
    {
        return view('guru.edit', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:4|confirmed'
            ]);

            $validated['password'] = bcrypt($validated['password']);

            User::create($validated);
            return redirect()->route('guru.index')->with('success', 'Data Guru berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:users,name,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:4|confirmed',
            ]);

            if (!empty($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id): RedirectResponse
    {
        try {

            $user = User::where('id', $id)->first();
            $user->delete();
            return redirect()->route('guru.index')->with('success', 'Data Guru berhasil dihapus');
        } catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
