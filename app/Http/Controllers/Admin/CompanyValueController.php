<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyValueController extends Controller
{
    public function index()
    {
        $values = CompanyValue::orderBy('order')->get();

        return view('admin.values.index', [
            'title'  => 'Nilai Perusahaan',
            'values' => $values,
        ]);
    }

    public function show(CompanyValue $value)
    {
        return response()->json([
            'success' => true,
            'value'   => [
                'id'          => $value->id,
                'name'        => $value->name,
                'description' => $value->description,
                'order'       => $value->order,
                'image_url'   => $value->image_path ? asset('storage/' . $value->image_path) : null,
                'created_at'  => $value->created_at?->format('d-m-Y H:i'),
                'updated_at'  => $value->updated_at?->format('d-m-Y H:i'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('company_values', 'public');
        }

        $value = CompanyValue::create($data);

        return response()->json([
            'success' => true,
            'value'   => $this->mapValue($value),
        ]);
    }

    public function update(Request $request, CompanyValue $value)
    {
        $data = $this->validateData($request, $value->id);

        if ($request->hasFile('image')) {
            if ($value->image_path) {
                Storage::disk('public')->delete($value->image_path);
            }
            $data['image_path'] = $request->file('image')->store('company_values', 'public');
        }

        $value->update($data);

        return response()->json([
            'success' => true,
            'value'   => $this->mapValue($value),
        ]);
    }

    public function destroy(CompanyValue $value)
    {
        if ($value->image_path) {
            Storage::disk('public')->delete($value->image_path);
        }

        $value->delete();

        return response()->json(['success' => true]);
    }

    // ----------------- helper -----------------

    protected function validateData(Request $request, $id = null): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);
    }

    protected function mapValue(CompanyValue $value): array
    {
        return [
            'id'          => $value->id,
            'name'        => $value->name,
            'description' => $value->description,
            'order'       => $value->order,
            'image_url'   => $value->image_path ? asset('storage/' . $value->image_path) : null,
            'created_at'  => $value->created_at?->format('d-m-Y'),
            'updated_at'  => $value->updated_at?->format('d-m-Y'),
        ];
    }
}

