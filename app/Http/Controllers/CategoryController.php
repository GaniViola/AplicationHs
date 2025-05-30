<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.pages.categories', [
            'title' => 'Daftar Kategori',
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.pages.categories.create', [
            'title' => 'Tambah Kategori'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:200',
            'description' => 'nullable'
        ]);

        DB::transaction(function () use ($request) {
            Category::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
        });

        return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.categories.edit', [
            'title' => 'Edit Kategori',
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200|unique:categories,name,'.$id,
            'description' => 'nullable'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
{
    try {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    } catch (QueryException $e) {
        // Cek apakah error-nya karena foreign key constraint
        if ($e->getCode() == 23000) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena sedang digunakan.');
        }

        // Tangani error lain
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori.');
    }
}
}
