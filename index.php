 <?php

    include 'perjalanan.php';
    include 'konek.php';
    // Membuat objek dari kelas Bayar
    $proses = new Bayar();
    $proses->setHarga(700000, 1300000, 2000000, 2700000);
    if (isset($_POST['kirim'])) {
        $proses->jumlah = $_POST['jumlah'];
        $proses->jenis = $_POST['jenis'];
        $proses->nama = $_POST['nama'];


        //Menyimpan data pembelian ke database
        $proses->simpanpembayaran($men);
    }

    //Mengambil semua data pembelian untuk ditampilkan
    $dataPembelian = $proses->ambilSemua($men);

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tiket</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            h1 {
                color: #4CAF50;
            }
            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }


            input[type="text"], input[type="number"], select {
                width: 100%;
                padding: 8px;
                margin-top: 5px;
                box-sizing: border-box;
            }

            form {
                width: 50%;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            @media (max-width: 900px) {
                table, form {
                    width: 98%;
                }

                th, td {
                    padding: 8px;
                    font-size: 14px;
                }
            }

            @media (max-width: 600px) {
                body {
                    padding: 0;
                }

                form, table {
                    width: 100%;
                    margin: 10px 0;
                    font-size: 14px;
                }

                th, td {
                    padding: 6px;
                    font-size: 12px;
                }

                h1, h3 {
                    font-size: 18px;
                }

                input[type="text"], input[type="number"], select {
                    font-size: 14px;
                }
            }
            
        </style>
    </head>
    <body>
        <center>
            <form action="" method="POST">
                <h1>pembelian tiket konser</h1>
                <table>
                    <tr>
                <td> <label>Nama Pelanggan:</label><br></td>
                <td> <input  type="text" name="nama"></td>
                    </tr>
                    <tr>
                        <td>Masukan Jumlah Tiket:</td>
                        <td>
                            <input type="number" name="jumlah" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Pilih Jenis Tiket:</td>
                        <td>
                            <select name="jenis" required>      
                                <option value="Silver">Silver</option>
                                <option value="Platinum">Platinum</option>
                                <option value="Premium">Premium</option>
                                <option value="VIP">VIP</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    <td colspan="1">
                        <input type="submit"  value="beli" name="kirim">
                    </td>
                    </tr>

                </table>
            </form>

             <!-- Menampilkan data pembelian -->
         <h3>Riwayat Pembelian</h3>
        <table border="1" cellpadding="8">
            <tr>
                <th>No</th>
                <th>tanggal</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Detail</th>
            </tr>
            <?php
                // Menampilkan data pembelian dengan foreach
                $no = 1;
                foreach($dataPembelian as $row) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['Tanggal'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['Jenis'] . "</td>";
                    echo "<td>" . $row['Jumlah'] . "</td>";
                    echo "<td>Rp. " . number_format($row['Totalharga'], 0, ',', '.') . "</td>";
                    echo "<td> <a href='aksi.php?id=" .
                    $row['Id'] . 
                    "' target='_blank'>Detail
                    </a>" .
                    "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        </center>
        
    </body>
</html>

   