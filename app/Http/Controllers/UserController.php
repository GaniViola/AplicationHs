<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;

use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class UserController extends Controller
{

    public function index() {
        return view('admin.pages.accoount', [
            'title' => 'Create Account',
            'services' => Service::all()
        ]);
    }

    // Create account
    public function CreateAccount(Request $request) {

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email:rfc,dns|unique:users,email',
            'address'  => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'photo'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'role'     => 'required|in:admin,worker,customer',
            'skills'   => 'required|array',
            'skills.*' => 'exists:services,id'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('userphoto', 'public');
        }

        $user = User::create([
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'address'  => $validated['address'],
            'phone'    => $validated['phone'],
            'role'     => $validated['role'],
            'photo'    => $validated['photo'],
        ]);

        if (!empty($validated['skills'])) {
            $user->service()->attach($validated['skills']);
        }

        return back()->with('createsuccess', 'Cerate account user success');
    }

    // User Master
    public function ShowUserMaster(Request $request) {

        $role = $request->role;
        $search = $request->searchuser;

        return view('admin.pages.UserMaster', [
            'title' => 'User Master',
            'users' => User::with('service')->latest()->search($search)->role($role)->get()
        ]);
        
    }

    // menghapus data user
    public function destroy($id) {

        $user = User::find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        
        $user->delete();
        
        return back()->with('success', 'Data berhasil dihapus.');
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