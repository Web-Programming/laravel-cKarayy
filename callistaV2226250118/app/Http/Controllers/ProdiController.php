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
}
