<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Suppliers;

class SuppliersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Retrieve supplier data with pagination and search
        $suppliers = Suppliers::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%')
                             ->orWhere('phone', 'like', '%' . $search . '%')
                             ->orWhere('address', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('suppliers.index', compact('suppliers'));
    }

    public function show($id)
    {
    }

    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:suppliers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Suppliers::create($request->all());

        return redirect()->route('suppliers.index')->with('status', 'success')->with('message', 'Supplier created successfully.');
    }
    public function edit(string $id)
    {
        $suppliers = Suppliers::findOrFail($id);
        return view('suppliers.edit', compact('suppliers'));
    }

    public function update(Request $request, $id)
    {
        $suppliers = Suppliers::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:suppliers,email,' . $suppliers->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $suppliers->update($request->all());

        return redirect()->route('suppliers.index')->with('status', 'success')->with('message', 'Supplier updated successfully.');
    }


    public function destroy($id)
    {
        $suppliers = Suppliers::findOrFail($id);
        $suppliers->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }

}
