<?php

class Tiket{
    public $jumlah;
    public $jenis;
    private $Silver, $Platinum, $Premium, $VIP;
    public $fasilitas;
    public $nama;
    protected $ppn;

    public function __construct(){
        $this->ppn = 0.12;
    }

    public function setHarga($tipe1, $tipe2, $tipe3, $tipe4){
        $this->Silver = $tipe1;
        $this->Platinum = $tipe2;
        $this->Premium = $tipe3;
        $this->VIP = $tipe4;
    }

    public function getHarga(){
        return [    
            'Silver' => $this->Silver,
            'Platinum'=> $this->Platinum,
            'Premium'=> $this->Premium,
            'VIP' => $this->VIP,
        ];
    }  

    public function getfasilitas($fasilitas){
    if ($fasilitas == "Silver"){
        return "masuk reguler";
    }elseif($fasilitas == "Platinum"){
        return "snack";
    } if ($fasilitas == "Premium"){
        return "free minuman dan snack";
    }elseif($fasilitas == "VIP"){
        return "greet meet dan souvenir";
    }

  }

}
  

class Bayar extends Tiket{
    public function hargaBeli(): float {
        // Menghitung harga beli berdasarkan jumlah dan jenis tiket
        $hargaBeli = $this->jumlah * $this->getHarga()[$this->jenis];
        $hargaPPN = $hargaBeli * $this->ppn;
        $Total = $hargaBeli + $hargaPPN;
        $this->fasilitas = $this->getfasilitas($this->jenis);
        return $Total;
    }

    //Simpan data pembelian ke database
    public function simpanpembayaran($men):void {
       // ambil tanggal hari ini

        // hitung harga total pembelian
        $total = $this->hargaBeli();

        // query insert statement
        $smp = $men->prepare("INSERT INTO pesanan (nama, Jumlah, Jenis, fasilitas, Totalharga) VALUES (?, ?, ?, ?, ?)");

        //isi parameter ke quary
        $smp->bind_param("sissi", $this->nama, $this->jumlah, $this->jenis, $this->fasilitas, $total);

        //jalanakan quary ke database
        $smp->execute();

    }

    //menampilkan seluruh data dari tabel pembelian
    public function ambilSemua($men): array {

     //Query untuk mengambil semua data diurutkan berdasarkan id
     $sql = "SELECT * FROM pesanan ORDER BY id ASC";

     // jalankan query  
     $result = $men->query($sql);

     //array kosong untuk menampung data
     $data = [];

     //ambil data satu per satu dan masukkan ke dalam array
     while ($row = $result->fetch_assoc()) {
         $data[] = $row;
        }  

        // Kembalikan seluruh data dalam bentuk array
        return $data;
    }

    //menampilkan data pembelian berdasarkan id tertentu
    public function ambilById($men, $id): mixed {

        //Query untuk mengambil data berdasarkan id
        $sql = "SELECT * FROM pesanan WHERE id = ?";

        // siapkan dan isi parameter query
        $smp = $men->prepare($sql);
        $smp->bind_param("i", $id);

        //jalankan query
        $smp->execute();

        //ambil hasil query
        $result = $smp->get_result();
        return $result->fetch_assoc();
    }
}
?>