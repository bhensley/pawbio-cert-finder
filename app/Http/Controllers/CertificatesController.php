<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Certificate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $certificates = Certificate::where('po', 'LIKE', "%$keyword%")
                ->orWhere('part_number', 'LIKE', "%$keyword%")
                ->orWhere('certificate_file', 'LIKE', "%$keyword%")
                ->orWhere('uploaded_by', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $certificates = Certificate::latest()->paginate($perPage);
        }

        return view('certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'po'                => 'required',
            'part'              => 'required',
            'lot'               => 'required',
			'certificate_file'  => 'required'
		]);
        $requestData = $request->all();

        if ($request->hasFile('certificate_file')) {
            $requestData['certificate_file'] = $request->file('certificate_file')
                ->store('uploads', 'public');
        }

        $requestData['uploaded_by'] = Auth::user()->id;

        Certificate::create($requestData);

        return redirect('certificates')->with('flash_message', 'Certificate added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);

        return view('certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);

        return view('certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'po' => 'required',
			'part_number' => 'required',
			'certificate_file' => 'required'
		]);
        $requestData = $request->all();
                if ($request->hasFile('certificate_file')) {
            $requestData['certificate_file'] = $request->file('certificate_file')
                ->store('uploads', 'public');
        }

        $certificate = Certificate::findOrFail($id);
        $certificate->update($requestData);

        return redirect('certificates')->with('flash_message', 'Certificate updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Certificate::destroy($id);

        return redirect('certificates')->with('flash_message', 'Certificate deleted!');
    }
}
