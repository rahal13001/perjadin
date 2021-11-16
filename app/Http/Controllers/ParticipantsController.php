<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Spending;
use Illuminate\Http\Request;

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
        $spendings = Spending::all();
        $participants = Participant::all();
        return view('admin.participants.create', compact('partcipants'), compact('spendings'));
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
        $data['spd_belakang'] = $request->file('spd_belakang')->store('spd_belakang', 'public');
        $data['spd_depan'] = $request->file('spd_depan')->store('spd_depan', 'public');
        $data['laporan'] = $request->file('laporan')->store('laporan', 'public');
        $data['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi', 'public');

        $participants = new Participant;
        $participants->spd_belakang = $data['spd_belakang'];
        $participants->spd_depan = $data['spd_depan'];
        $participants->spd_laporan = $data['laporan'];
        $participants->dokumentasi = $data['dokumentasi'];
        $participants->save();

        if (count(array($data['standard_id'] > 0))) {
            foreach ($data['standard_id'] as $item => $value) {
                $data2 = array(
                    'standards_id' => $participants->id,
                    'standards_id' => $data['standard_id'][$item]
                );
                Spending::create($data2);
            }
        }

        dd($data2);

        if (count(array($data['nominal'] > 0))) {
            foreach ($data['nominal'] as $item => $value) {
                $data2 = array(
                    'nominal' => $participants->id,
                    'nominal' => $data['nominal'][$item]
                );
                Spending::create($data2);
            }
        }

        if (count(array($data['kwitansi'] > 0))) {
            foreach ($data['kwitansi'] as $item => $value) {
                $data2 = array(
                    'kwitansi' => $participants->id,
                    'kwitansi' => $data['kwitansi'][$item]
                );
                Spending::create($data2);
            }
        }


        return redirect()->route('admin.letters.letters')->with('status', 'Data Perjalanan Dinas Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
