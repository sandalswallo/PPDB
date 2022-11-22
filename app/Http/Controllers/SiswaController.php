<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        $siswa = Siswa::all();
        
        $jurusan = Jurusan::all();
        
        return view('siswa.index', compact('siswa', 'jurusan', ));
    }

    public function data()
    {
        $siswa = Siswa::orderBy('id', 'desc')->get();

        return datatables()
            ->of($siswa)
            ->addIndexColumn()
            ->addColumn('jurusan_id', function($siswa){
                return !empty($siswa->jurusan->nama) ? $siswa->jurusan->nama : '-';
            })
            // ->addColumn('tempat_id', function($siswa){
            //     return !empty($siswa->tempat->nama) ? $siswa->tempat->nama : '-';
            // })
            ->addColumn('aksi', function($siswa){
                return '
                <div class="btn-group">
                    <button onclick="editData(`' .route('siswa.update', $siswa->id). '`)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`' .route('siswa.destroy', $siswa->id). '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'jurusan_id', ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'asal_sekolah' => 'required',
            'jurusan_id' => 'required',
           
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $siswa = Siswa::create([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'asal_sekolah' => $request->asal_sekolah,
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
            'data' => $siswa
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa.form', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->jurusan = $request->jurusan;
        $siswa->kelas = $request->kelas;
        $siswa->asal_sekolah = $request->asal_sekolah;
        $siswa->update();

        return response()->json('Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return redirect('siswa');
    }
}