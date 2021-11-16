<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Participant;
use App\Spending;
use App\Letter;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Spending $spending, Participant $participant, Letter $letter)
    {
        $spendings = Spending::all();
        $participants = Participant::all();
        $letter = Letter::all();
        return view('admin.participants.edit', compact('partcipants'), compact('spendings'), compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Letter $letter)
    {
        $data = $request->all();
        // dd($data);

        $data['dokumentasi'] = [];
        $data['spd_belakang'] = $request->file('spd_belakang')->store('spd_belakang', 'public');
        $data['spd_depan'] = $request->file('spd_depan')->store('spd_depan', 'public');
        $data['laporan'] = $request->file('laporan')->store('laporan', 'public');
        foreach ($request->file('dokumentasi') as $dokumen) {
            array_push($data['dokumentasi'], $dokumen->store('dokumentasi', 'public'));
        }


        // Participant::where('letters_id', $letter->id)
        //     ->update([
        //         'spd_belakang' => $data['spd_belakang'],
        //         'spd_depan' => $data['spd_depan'],
        //         'laporan' => $data['laporan'],
        //         'dokumentasi' => json_encode($data['dokumentasi'])
        //     ]);
        $participants = Participant::where('letters_id', $data['letter_id']);
        $participants->update([
            'spd_belakang' => $data['spd_belakang'],
            'spd_depan' => $data['spd_depan'],
            'laporan' => $data['laporan'],
            'dokumentasi' => json_encode($data['dokumentasi'])
        ]);

        // $participants->spd_belakang = $data['spd_belakang'];
        // $participants->spd_depan = $data['spd_depan'];
        // $participants->laporan = $data['laporan'];
        // $participants->dokumentasi = json_encode($data['dokumentasi']);
        // $participants->save();
        foreach ($request->file('kwitansi') as $dokumen) {
            array_push($data['kwitansi'], $dokumen->store('dokumentasi', 'public'));
        }

        foreach ($participants->get() as $participant) {


            if (count(array($data['standard_id'] > 0))) {

                foreach ($data['standard_id'] as $item => $value) {
                    $kwitansi =
                        $data2 = array(
                            'participants_id' => $participant->id,
                            'standards_id' => $data['standard_id'][$item],
                            'nominal' => $data['nominal'][$item],
                            'kwitansi' => $data['kwitansi'][$item]
                        );
                    Spending::create($data2);
                }
            }

            // // dd($data2);
            // if (count(array($data['nominal'] > 0))) {
            //     foreach ($data['nominal'] as $item => $value) {
            //         $data2 = array(
            //             'nominal' => $participant->id,
            //             'nominal' => $data['nominal'][$item]
            //         );
            //         Spending::create($data2);
            //     }
            // }


            // if (count(array($data['kwitansi'] > 0))) {
            //     foreach ($data['kwitansi'] as $item => $value) {
            //         $data2 = array(
            //             'kwitansi' => $participant->id,
            //             'kwitansi' => $data['kwitansi'][$item]
            //         );
            //         Spending::create($data2);
            //     }
            // }
        }


        return redirect()->route('admin.letters.letters')->with('status', 'Data Perjalanan Dinas Berhasil Ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
