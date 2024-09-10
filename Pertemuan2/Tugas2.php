<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin : 0 auto;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        h2{
            text-align : center;
        }
    </style>
</head>
<body>
    <h2>DATA MAHASISWA</h2>
    <?php
    function hitung_rata($array) {
        if (empty($array)) return 0; 
        $jumlah = array_sum($array);
        $rata = $jumlah / count($array);
        return $rata;
    }

    function print_mhs($array_mhs) {
        echo "<table>
                <tr>
                    <th>Nama</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                    <th>Nilai 3</th>
                    <th>Rata2</th>
                </tr>";
        
        foreach ($array_mhs as $nama => $nilai) {
            $rata_rata = hitung_rata($nilai); 
            echo "<tr>
                    <td>$nama</td>
                    <td>{$nilai[0]}</td>
                    <td>{$nilai[1]}</td>
                    <td>{$nilai[2]}</td>
                    <td>$rata_rata</td>
                  </tr>";
        }
        echo "</table>";
    }

    $array_mhs = array(
        'Abdul' => array(89, 90, 54),
        'Budi' => array(98, 65, 74),
        'Nina' => array(67, 56, 84),
    );

    print_mhs($array_mhs);
    ?>
</body>
</html>
