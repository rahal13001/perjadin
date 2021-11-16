<?php

namespace App\Http\Controllers\Admin;

use App\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\admin\EmployeRequest;



class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Employe::query();
            return DataTables::of($query)
                // return view('admin.employes.employes')
                ->addColumn('aksi', function ($item) {
                    return '
                <a href = "' . route('employes.show', $item->id) . '"
                class = "btn btn-info">
                    Detail </a>
                ';
                })->rawColumns(['aksi'])
                ->make();
        }

        return view('admin.employes.employes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeRequest $request)
    {
        $data = $request->all();
        $data['foto'] = $request->file('foto')->store('foto', 'public');

        Employe::create($data);
        return redirect()->route('employes.index')->with('status', 'Data Pegawai Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        return view('admin.employes.detail', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        // $item = Employe::findOrFail($id);

        // return view('admin.employes.edit', [
        //     'item' => $item
        // ]);
        return view('admin.employes.edit', compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employe)
    {
        $old = Employe::all(['foto']);
        Storage::delete($old);


        $data = $request->all();
        $data['foto'] = $request->file('foto')->store('foto', 'public');

        // $item = Employe::findOrFail($employe);

        // $item->update($data);

        Employe::where('id', $employe->id)
            ->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'umur' => $request->umur,
                'pangkat' => $request->pangkat,
                'jabatan' => $request->jabatan,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'tipe' => $request->tipe,
                'status' => $request->status,
                'foto' => $request->file('foto')
            ]);
        return redirect()->route('employes.index')->with('status', 'Data Pegawai Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        Employe::destroy($employe->id);
        return redirect()->route('employes.index')->with('status', 'Data Pegawai Berhasil Dihapus');
    }
}
