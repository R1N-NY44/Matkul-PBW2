<?php

namespace App\Http\Controllers;


use App\Models\Collection;
use Illuminate\Http\Request;
use App\DataTables\CollectionsDataTable;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CollectionsDataTable $dataTable)
    {
        // $collections = Collection::all();
        // return view('koleksi.daftarKoleksi', compact('collections'));
        return $dataTable->render('koleksi.daftarKoleksi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('koleksi.registrasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // IGN Brindawan Tri Guna Yoga - 6706223062
            'namaKoleksi' => ['required', 'string', 'max:10'],
            'jenisKoleksi' => ['required', 'integer', 'max:4'],
            'jumlahKoleksi' => ['required', 'integer'],
        ]);
        $collection = Collection::create([
            'namaKoleksi' => $request->namaKoleksi,
            'jenisKoleksi' => $request->jenisKoleksi,
            'jumlahKoleksi' => $request->jumlahKoleksi,
        ]);

        $collection->save();
        return redirect('/koleksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collection = Collection::find($id);
        return view('koleksi.infoKoleksi', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        //
    }

    public function getAllCollections()
{
    $collections = DB::table('collections')
        ->select('id as id', 'nama as judul', DB::raw('
            CASE
                WHEN jenis="1" THEN "Buku"
                WHEN jenis="2" THEN "Majalah"
                WHEN jenis="3" THEN "Cakram Digital"
            END AS jenis'), 'jumlah as jumlah')
        ->orderBy('nama', 'asc')
        ->get();

    return DataTables::of($collections)
        ->addColumn('action', function ($collection) {
            $html = '
            <button data-rowid="" class="btn btn-xs btn-light" data-toggle="tooltip" data-placement="top" data-container="body" title="Edit Koleksi" onclick="infoKoleksi(' . "'" . $collection->id . "'" . ')"> <i class="fa fa-edit"></i></button>
            ';
            return $html;
        })
        ->make(true);
}
}
