<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\GensetSpec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class GensetController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();

        // ambil brand pertama sebagai default
        $selectedBrand = null;

        if ($request->brand) {
            $selectedBrand = Brand::with('specs')
                ->find($request->brand);
        } else {
            $selectedBrand = Brand::with('specs')
                ->first();
        }

        $models = collect();

        if ($selectedBrand) {
            $models = GensetSpec::where('brand_id', $selectedBrand->id)
                ->pluck('model')
                ->unique();
        }

        return view('admin.genset.index', compact(
            'brands',
            'selectedBrand',
            'models'
        ));
    }




    /* ================= BRAND ================= */

    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required',
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

        return back()->with('success','Brand created!');
    }

    public function updateBrand(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->is_active
        ];

        if ($request->hasFile('logo')) {

            // delete logo lama
            if ($brand->logo && Storage::exists('public/'.$brand->logo)) {
                Storage::delete('public/'.$brand->logo);
            }

            $file = $request->file('logo');
            $filename = 'brands/'.time().'_'.$file->getClientOriginalName();
            $file->storeAs('public',$filename);

            $data['logo'] = $filename;
        }

        $brand->update($data);

        return back()->with('success','Brand updated!');
    }


    /* ================= SPEC ================= */

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

        $data = $request->except('image');

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
        'model','engine','alternator','kva','kw','fuel'
    ]);

    if ($request->hasFile('image')) {

        // hapus file lama kalau ada
        if ($spec->image && Storage::exists('public/'.$spec->image)) {
            Storage::delete('public/'.$spec->image);
        }

        $file = $request->file('image');
        $filename = 'gensets/'.time().'_'.$file->getClientOriginalName();
        $file->storeAs('public', $filename);

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

}
