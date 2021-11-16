<?php

namespace App\Http\Controllers\Admin;

use App\Standard;
use App\Region;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class StandardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Standard::query();
            return DataTables::of($query)
                ->addColumn('aksi', function ($standard) {
                    return '

                    <a href = "' . route('standards.edit', $standard->id) . '"
                    class = "btn btn-warning float-left">
                        Edit </a>
                     <form action="' . route('standards.destroy', $standard->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
            </div>';
                })->rawColumns(['aksi'])->make();
        }
        return view('admin.standards.standards');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::whereRaw('CHAR_LENGTH(kode)=2')->orderBy('provinsi')->get();
        return view('admin.standards.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Standard::create($data);
        return redirect()->route('standards.index')->with('status', 'Data SBU Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Standard $standard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Standard $standard)
    {
        $regions = Region::whereRaw('CHAR_LENGTH(kode)=2')->orderBy('provinsi')->get();
        return view('admin.standards.edit', compact('regions'), compact('standard'));
        // return view('admin.standards.edit', compact('standard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Standard $standard)
    {
        $request->all();

        Standard::where('id', $standard->id)
            ->update([
                'jenis_sbu' => $request->jenis_sbu,
                'provinsi' => $request->provinsi,
                'maksimal' => $request->maksimal
            ]);
        return redirect()->route('standards.index')->with('status', 'Data SBU Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Standard $standard)
    {
        Standard::destroy($standard->id);
        return redirect()->route('budgets.index')->with('status', 'Data SBU Berhasil Dihapus');
    }
}
