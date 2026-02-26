<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GensetInquiry;


class GensetInquiryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $inquiries = GensetInquiry::with('spec.brand')
                        ->latest()
                        ->get();

        return view('admin.requests.index', compact('inquiries'));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW (AJAX DETAIL)
    |--------------------------------------------------------------------------
    */
    public function show(GensetInquiry $inquiry)
    {
        return response()->json([
            'success' => true,
            'inquiry' => $this->transform($inquiry->load('spec.brand')),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(GensetInquiry $inquiry)
    {
        $inquiry->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | FORMAT RESPONSE
    |--------------------------------------------------------------------------
    */
    protected function transform(GensetInquiry $q): array
    {
        return [
            'id' => $q->id,
            'name' => $q->name,
            'email' => $q->email,
            'phone' => $q->phone,
            'address' => $q->address,
            'note' => $q->note,

            'brand' => optional($q->spec->brand)->name,
            'model' => optional($q->spec)->model,

            'engine' => optional($q->spec)->engine,
            'alternator' => optional($q->spec)->alternator,

            'image_url' => $q->spec && $q->spec->image
                ? asset('storage/' . $q->spec->image)
                : null,

            'created_at' => optional($q->created_at)->format('d-m-Y H:i'),
        ];
    }
}