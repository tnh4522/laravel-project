<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryFormRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.list', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryFormRequest $request)
    {
        return Country::create($request->all())
            ? redirect('admin/country/list')->with('success', 'Add Country success!')
            : redirect()->back()->with('error', 'Add Country failed!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.country.edit', [
            'country' => Country::find($id),
            'countries' => Country::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryFormRequest $request, string $id)
    {
        return Country::find($id)->update($request->all())
            ? redirect('admin/country/list')->with('success', 'Update success!')
            : redirect()->back()->with('error', 'Update failed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Country::find($id)->delete()
            ? redirect()->back()->with('success', 'Delete success!')
            : redirect()->back()->with('error', 'Delete failed!');
    }
}
