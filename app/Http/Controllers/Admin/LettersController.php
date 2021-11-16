<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Letter;
use App\Budget;
use App\Employe;
use App\Standard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\admin\LetterRequest;
use App\Participant;
use PhpParser\Lexer;

class LettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $query = Letter::query();
            return DataTables::of($query)
                ->addColumn('aksi', function ($item) {
                    return '
                <a href = "' . route('letters.show', $item->id) . '"
                class = "btn btn-info">
                    Detail </a>
                ';
                })->rawColumns(['aksi'])
                ->make();
        }

        return view('admin.letters.letters');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $budgets = Budget::all();
        $employes = Employe::all();
        return view('admin.letters.create', compact('budgets'), compact('employes'));
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
        // dd($data);
        $letter = new Letter;
        $letter->no_spt = $data['no_spt'];
        $letter->tujuan = $data['tujuan'];
        $letter->budgets_id = $data['budgets_id'];
        $letter->tanggal = $data['tanggal'];
        $letter->tgl_sls = $data['tgl_sls'];
        $letter->agenda = $data['agenda'];
        $letter->durasi = $data['durasi'];
        $letter->keterangan = $data['keterangan'];
        $letter->save();

        if (count(array($data['employes_id'] > 0))) {
            foreach ($data['employes_id'] as $item => $value) {
                $data2 = array(
                    'letters_id' => $letter->id,
                    'employes_id' => $data['employes_id'][$item]
                );
                Participant::create($data2);
            }
        }


        // Letter::create(array($letter));

        return redirect()->route('letters.index')->with('status', 'Data SPT Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function show(Letter $letter, Participant $participant, Standard $standard)
    {
        // $participant = Participant::with('employe')->where('letters_id', $letter['id'])->get();
        // dd($participant);
        $participant = Participant::join('employes', 'participants.employes_id', 'employes.id')->where('letters_id', $letter->id)->get();
        // dd($participant);
        $standard = Standard::all();
        return view('admin.letters.detail')->with(['letter' => $letter, 'participant' => $participant, 'standard' => $standard]);
    }

    /**1
     * Show the form for editing the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit(Letter $letter)
    {
        $budgets = Budget::all();
        return view('admin.letters.edit', compact('letter'), compact('budgets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Letter $letter)
    {
        $request->all();

        Letter::where('id', $letter->id)
            ->update([
                'no_spt' => $request->no_spt,
                'tujuan' => $request->tujuan,
                'budgets_id' => $request->budgets_id,
                'keterangan' => $request->keterangan,
                'agenda' => $request->agenda,
                'tanggal' => $request->tanggal,
                'durasi' => $request->durasi
            ]);
        return redirect()->route('letters.index')->with('status', 'Data SPT Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Letter $letter)
    {
        Letter::destroy($letter->id);
        return redirect()->route('letters.index')->with('status', 'Data SPT Berhasil Dihapus');
    }
}
