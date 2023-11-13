<?php
namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller{
    public function allJoinFacade(){
        $kampus = "Universitas Multi Data Palembang";
        // return view("prodi.index")-> with('kampus',$kampus);

        $result = DB::select('select mahasiswas.*, prodis.nama as nama_prodi from prodis, mahasiswas where prodis.id = mahasiswas.prodi_id');
        return view("prodi.index",["allmahasiswaprodi"=>$result, "kampus" => $kampus]);
    }

    public function allJoinElq(){
        $prodis = Prodi::with('mahasiswas')-> get();
        foreach ($prodis as $prodi){
            echo "<h3>{$prodi->nama}</h3>";
            echo "<hr>Mahasiswa: ";
            foreach ($prodi -> mahasiswas as $mhs){
                echo $mhs -> nama . ", ";
            }
            echo "<hr>";
        }
    }

    public function create(){
        return view("prodi.create");
    }

    public function store(Request $request){
        // dump($request);
        // echo $request->nama;

        $validateData = $request->validate([
            "nama"=> "required|min:5|max:20",
        ]);
        // dump($validateData);
        // echo $validateData['nama'];

        $prodi =new Prodi(); //buat object podi
        $prodi->nama = $validateData['nama']; //simpan nilai input ke dalam property nama prodi
        $prodi-> save(); //simpan ke dlm tabel produs

        // return "Data p[ $prodi->nama berhasil disimpan dalam database"; //tampilkan pesan berhasil
        $request->session()->flash('info',"Data prodi $prodi->nama berhasil disimpan dalam database");
        return redirect('prodi/create');
    }

    public function index(){
        $prodis = Prodi::all();
        return view('prodi.index')-> with('prodis', $prodis);
    }

    public function show(Prodi $prodi){
        return view('prodi.show', ['prodi' => $prodi]);
    }

    public function edit(Prodi $prodi){
        return view('prodi.edit', ['prodi' => $prodi]);
    }

    public function update(Request $request, Prodi $prodi){
        $validateData = $request->validate([
            'nama'=> 'required|min:5|max:20',
        ]);

        Prodi::where('id', $prodi->id)->update($validateData);
        $request->session()->flash('info',"Data Prodi $prodi->nama berhasil diubah");
        return redirect()->route('prodi.index');
    }
}
