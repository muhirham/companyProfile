<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\GensetSpec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();

        $selectedBrand = $request->brand
            ? Brand::with('specs')->find($request->brand)
            : Brand::with('specs')->first();

        $models = collect();

        if ($selectedBrand) {
            $models = GensetSpec::where('brand_id', $selectedBrand->id)
                ->pluck('model')
                ->unique();
        }

        return view('admin.products.index', compact(
            'brands',
            'selectedBrand',
            'models'
        ));
    }

    public function storeSpec(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'model' => 'required',
            'engine' => 'required',
            'image' => 'nullable|image'
        ]);

        $exists = GensetSpec::where('brand_id', $request->brand_id)
            ->where('model', $request->model)
            ->exists();

        if ($exists) {
            return back()->with('error','Model already exists for this brand!');
        }

        $data = $request->only([
            'brand_id',
            'model',
            'engine',
            'alternator',

            'prp_kva',
            'esp_kva',
            'prp_kw',
            'esp_kw',

            'fuel',

            'l_open',
            'w_open',
            'h_open',
            'kg_open',

            'l_silent',
            'w_silent',
            'h_silent',
            'kg_silent',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'gensets/'.time().'_'.$file->getClientOriginalName();
            $file->storeAs('public',$filename);
            $data['image'] = $filename;
        }

        GensetSpec::create($data);

        return back()->with('success','Spec added!');
    }

    public function updateSpec(Request $request,$id)
    {
        $spec = GensetSpec::findOrFail($id);

        $data = $request->only([
            'model','engine','alternator',

            'prp_kva','esp_kva','prp_kw','esp_kw',

            'fuel',

            'l_open','w_open','h_open','kg_open',

            'l_silent','w_silent','h_silent','kg_silent'
        ]);

        if ($request->hasFile('image')) {

            if ($spec->image && Storage::exists('public/'.$spec->image)) {
                Storage::delete('public/'.$spec->image);
            }

            $file = $request->file('image');
            $filename = 'gensets/'.time().'_'.$file->getClientOriginalName();
            $file->storeAs('public',$filename);

            $data['image'] = $filename;
        }

        $spec->update($data);

        return back()->with('success','Spec updated!');
    }

    public function deleteSpec($id)
    {
        $spec = GensetSpec::findOrFail($id);

        if ($spec->image && Storage::exists('public/'.$spec->image)) {
            Storage::delete('public/'.$spec->image);
        }

        $spec->delete();

        return back()->with('success','Spec deleted!');
    }
    public function updateBrand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->is_active,
        ];

        // ⚠️ HANYA update logo kalau ada file baru
        if ($request->hasFile('logo')) {

            // hapus file lama kalau ada
            if ($brand->logo && Storage::exists('public/'.$brand->logo)) {
                Storage::delete('public/'.$brand->logo);
            }

            $file = $request->file('logo');
            $filename = 'brands/'.time().'_'.$file->getClientOriginalName();
            $file->storeAs('public', $filename);

            $data['logo'] = $filename;
        }

        $brand->update($data);

        return back()->with('success','Brand updated!');
    }

    // ================= STORE BRAND =================
    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'logo' => 'nullable|image'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => 1
        ];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'brands/'.time().'_'.$file->getClientOriginalName();
            $file->storeAs('public',$filename);
            $data['logo'] = $filename;
        }

        Brand::create($data);

        return back()->with('success','Brand added!');
    }

    // ================= DELETE BRAND =================

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->specs()->count() > 0) {
            return back()->with('error','Cannot delete brand with specs!');
        }

        if ($brand->logo && Storage::exists('public/'.$brand->logo)) {
            Storage::delete('public/'.$brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.genset.index')
            ->with('success','Brand deleted!');
    }
}