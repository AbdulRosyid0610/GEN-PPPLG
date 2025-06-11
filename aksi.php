<?php
include 'konek.php';
include 'perjalanan.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $proses = new Bayar();
    $data = $proses->ambilById($men, $id);

    if ($data){
        

        echo "<style>
            .border {
                font-family: Arial, sans-serif;
                width: 400px;
                margin: auto;
                margin-top:20px;
                border: 2px solid #ccc;
                padding: 20px;
            }
            .header {
                text-align: center;
                border-bottom: 2px solid #000;
            }
            .jarak table{
                width: 100%;
                margin-left: 40px;
                font-weight: bold;
            }

        </style>";

        echo "<div class='border'>";
        echo "<div class='header'>";
        echo "<h2>rincian pembelian tiket</h2>";
        echo "</div>";
        echo "<div class='jarak'>";
        echo "<center>";
        echo "<table>";
        echo "<tr><td>Nama</td><td>: " .$data['nama'] ."</td></tr>";
        echo "<tr><td>Jenis Tiket</td><td>: " .$data['Jenis'] ."</td></tr>";
        echo "<tr><td>Jumlah</td><td>: " .$data['Jumlah'] ."</td></tr>";
        echo "<tr><td>Fasilitas</td><td>: " .$data['fasilitas'] ."</td></tr>";
        echo "<div class='garis'>";
        echo "<tr><td>Total Bayar</td><td>: Rp. " .number_format($data['Totalharga'], 0, "", ".") ."</td></tr>";
        echo "<tr><td>Tanggal</td><td>: " .$data['Tanggal'] ."</td></tr>";
        echo "</div>";
        echo "</table>";
        echo "</center>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "Data tidak ditemukan";
    }
} 
else {
    echo "ID tidak diberikan";
}

?>