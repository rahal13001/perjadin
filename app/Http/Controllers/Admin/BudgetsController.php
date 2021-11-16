<?php

namespace App\Http\Controllers\Admin;

use App\Budget;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\admin\BudgetRequest;


class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Budget::query();
            return DataTables::of($query)
                ->addColumn('aksi', function ($letter) {
                    return '

                    <a href = "' . route('budgets.edit', $letter->id) . '"
                    class = "btn btn-warning float-left">
                        Edit </a>
                     <form action="' . route('budgets.destroy', $letter->id) . '" method="POST">
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

        return view('admin.budgets.budgets');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.budgets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetRequest $request)
    {
        $data = $request->all();

        Budget::create($data);
        return redirect()->route('budgets.index')->with('status', 'Data Pegawai Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        return view('admin.budgets.detail', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('admin.budgets.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $request->all();

        Budget::where('id', $budget->id)
            ->update([
                'kode_anggaran' => $request->kode_anggaran,
                'mata_anggaran' => $request->mata_anggaran,
                'jumlah' => $request->jumlah,
                'dokumen' => $request->dokumen
            ]);
        return redirect()->route('budgets.index')->with('status', 'Data Anggaran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        Budget::destroy($budget->id);
        return redirect()->route('budgets.index')->with('status', 'Data Anggaran Berhasil Dihapus');
    }
}
