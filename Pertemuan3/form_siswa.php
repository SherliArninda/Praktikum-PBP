<?php
// Inisialisasi variabel untuk menampung error dan input
$nisErr = $namaErr = $genderErr = $kelasErr = $ekskulErr = "";
$nis = $nama = $gender = $kelas = "";
$ekskul = [];
$submitted = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true; 
    
    // Validasi NIS (harus 10 angka)
    if (empty($_POST["nis"])) {
        $nisErr = "NIS harus diisi";
    } elseif (!preg_match("/^[0-9]{10}$/", $_POST["nis"])) {
        $nisErr = "NIS harus terdiri dari 10 angka";
    } else {
        $nis = bersihkan_input($_POST["nis"]);
    }

    // Validasi Nama (harus diisi)
    if (empty($_POST["nama"])) {
        $namaErr = "Nama harus diisi";
    } else {
        $nama = bersihkan_input($_POST["nama"]);
    }

    // Validasi Jenis Kelamin (harus dipilih)
    if (empty($_POST["gender"])) {
        $genderErr = "Jenis kelamin harus dipilih";
    } else {
        $gender = bersihkan_input($_POST["gender"]);
    }

    // Validasi Kelas (harus dipilih)
    if (empty($_POST["kelas"])) {
        $kelasErr = "Kelas harus dipilih";
    } else {
        $kelas = bersihkan_input($_POST["kelas"]);
    }

    // Validasi Ekstrakurikuler untuk kelas X dan XI
    if ($_POST["kelas"] != "XII") {
        if (empty($_POST["ekskul"])) {
            $ekskulErr = "Pilih minimal 1 kegiatan ekstrakurikuler";
        } elseif (count($_POST["ekskul"]) > 3) {
            $ekskulErr = "Pilih maksimal 3 kegiatan ekstrakurikuler";
        } else {
            $ekskul = $_POST["ekskul"];
        }
    }

    // Jika semua validasi lolos, tampilkan alert dan reload halaman
    if (empty($nisErr) && empty($namaErr) && empty($genderErr) && empty($kelasErr) && empty($ekskulErr)) {
        echo "<script>alert('Form berhasil disubmit!');</script>";
        // Reload halaman untuk mereset form setelah alert muncul
        echo "<script>window.location.href = window.location.href;</script>";
    }
}

// Fungsi untuk membersihkan input
function bersihkan_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Form Input Siswa</h2>
        <form id="form-siswa" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <!-- Input NIS -->
            <label for="nis"><strong>NIS:</strong></label> 
            <br>
            <input type="text" name="nis" placeholder="masukkan NIS..." value="<?php echo $nis;?>">
            <br>
            <?php if ($submitted && !empty($nisErr)): ?>
                <span class="error">* <?php echo $nisErr;?></span>
            <?php endif; ?>
            <br><br>

            <!-- Input Nama -->
            <label for="nama"><strong>Nama:</strong></label> 
            <br>
            <input type="text" name="nama" placeholder="masukkan nama..." value="<?php echo $nama;?>">
            <br>
            <?php if ($submitted && !empty($namaErr)): ?>
                <span class="error">* <?php echo $namaErr;?></span>
            <?php endif; ?>
            <br><br>

            <!-- Pilihan Jenis Kelamin -->
            <label for="jenis_kelamin"><strong>Jenis Kelamin:</strong></label>
            <br>
            <input type="radio" name="gender" value="Pria" <?php if (isset($gender) && $gender=="Pria") echo "checked";?>> Pria
            <br>
            <input type="radio" name="gender" value="Wanita" <?php if (isset($gender) && $gender=="Wanita") echo "checked";?>> Wanita
            <br>
            <?php if ($submitted && !empty($genderErr)): ?>
                <span class="error">* <?php echo $genderErr;?></span>
            <?php endif; ?>
            <br><br>

            <!-- Pilihan Kelas -->
            <label for="kelas"><strong>Kelas:</strong></label>
            <br>
            <select name="kelas" id="kelas" onchange="toggleEkskul()">
                <option value="">--Pilih Kelas--</option>
                <option value="X" <?php if ($kelas == "X") echo "selected";?>>X</option>
                <option value="XI" <?php if ($kelas == "XI") echo "selected";?>>XI</option>
                <option value="XII" <?php if ($kelas == "XII") echo "selected";?>>XII</option>
            </select>
            <br>
            <?php if ($submitted && !empty($kelasErr)): ?>
                <span class="error">* <?php echo $kelasErr;?></span>
            <?php endif; ?>
            <br><br>

            <!-- Bagian Ekstrakurikuler untuk kelas X dan XI -->
            <div id="ekskul-section" style="display: none;">
                <label for="ekskul"><strong>Ekstrakurikuler:</strong></label>
                <br>
                <input type="checkbox" name="ekskul[]" value="Pramuka" <?php if (in_array("Pramuka", $ekskul)) echo "checked";?>> Pramuka
                <br>
                <input type="checkbox" name="ekskul[]" value="Seni Tari" <?php if (in_array("Seni Tari", $ekskul)) echo "checked";?>> Seni Tari
                <br>
                <input type="checkbox" name="ekskul[]" value="Sinematografi" <?php if (in_array("Sinematografi", $ekskul)) echo "checked";?>> Sinematografi
                <br>
                <input type="checkbox" name="ekskul[]" value="Basket" <?php if (in_array("Basket", $ekskul)) echo "checked";?>> Basket
                <br>
                <?php if ($submitted && !empty($ekskulErr)): ?>
                    <span class="error">* <?php echo $ekskulErr;?></span>
                <?php endif; ?>
            </div>
            <br><br>

            <!-- Tombol Submit dan Reset -->
            <div class="button-container">
                <input type="submit" name="submit" value="Submit">
                <input type="reset" value="Reset" onclick="resetForm()">
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
