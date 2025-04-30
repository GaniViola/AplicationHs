<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index() {
        return view('admin.pages.accoount');
    }

    // Create account
    public function CreateAccount(Request $request) {

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email:rfc,dns|unique:users,email',
            'address'  => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'photo'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'role'     => 'required|in:admin,worker'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('services', 'public');
        }

        User::create($validated);

        return back()->with('createsuccess', 'Registration successful! please login');
    }
    
    // Menampilkan daftar customer
    public function customers(Request $request)
    {
        $search = $request->input('search');

        $customers = User::where('role', 'customer')
            ->when($search, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('id')
            ->get();

        return view('admin.pages.DataUser', compact('customers', 'search'));
    }

    // Blokir satu customer
    public function blockCustomer($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'blokir']);

        // Perbaikan - redirect ke nama route yang benar
        return redirect()->route('admin.customers')->with('success', 'Customer berhasil diblokir.');
    }

    // Aktifkan satu customer
    public function activateCustomer($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'aktif']);

        // Perbaikan - redirect ke nama route yang benar
        return redirect()->route('admin.customers')->with('success', 'Customer berhasil diaktifkan.');
    }

    // Bulk aksi: blokir atau aktifkan beberapa customer
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $userIds = $request->input('user_ids', []);

        if (empty($userIds)) {
            return redirect()->route('admin.customers')->with('error', 'Pilih minimal satu customer.');
        }

        $status = $action === 'block' ? 'blokir' : 'aktif';

        User::whereIn('id', $userIds)->update(['status' => $status]);

        $message = $action === 'block' ? 'Customer berhasil diblokir.' : 'Customer berhasil diaktifkan.';
        
        // Perbaikan - redirect ke nama route yang benar
        return redirect()->route('admin.customers')->with('success', $message);
    }

    
}