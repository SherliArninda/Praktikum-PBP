function tampilkanSubKategori() {
    const kategori = document.getElementById("kategori").value;
    const subKategori = document.getElementById("sub_kategori");

    // Hapus opsi yang ada sebelumnya
    subKategori.innerHTML = '';

    if (kategori === "baju") {
        subKategori.innerHTML = `
            <option value="">--Pilih Sub Kategori--</option>
            <option value="baju_pria">Baju Pria</option>
            <option value="baju_wanita">Baju Wanita</option>
            <option value="baju_anak">Baju Anak</option>
        `;
    } else if (kategori === "elektronik") {
        subKategori.innerHTML = `
            <option value="">--Pilih Sub Kategori--</option>
            <option value="mesin_cuci">Mesin Cuci</option>
            <option value="kulkas">Kulkas</option>
            <option value="ac">AC</option>
        `;
    } else if (kategori === "alat_tulis") {
        subKategori.innerHTML = `
            <option value="">--Pilih Sub Kategori--</option>
            <option value="kertas">Kertas</option>
            <option value="map">Map</option>
            <option value="pulpen">Pulpen</option>
        `;
    }
}

function validasiForm() {
    let namaProduk = document.getElementById("nama_produk").value;
    let deskripsiProduk = document.getElementById("deskripsi").value;
    let kategoriProduk = document.getElementById("kategori").value;
    let subKategori = document.getElementById("sub_kategori").value;
    let hargaSatuan = document.getElementById("harga_satuan").value;
    let grosirYa = document.getElementById("grosir_ya").checked;
    let grosirTidak = document.getElementById("grosir_tidak").checked;
    let hargaGrosir = document.getElementById("hrg_grosir").value;
    let jasaJNE = document.getElementById("jasa_jne").checked;
    let jasaTIKI = document.getElementById("jasa_tiki").checked;
    let jasaSiCepat = document.getElementById("jasa_sicepat").checked;
    let jasaNinja = document.getElementById("jasa_ninja").checked;
    let jasaWahana = document.getElementById("jasa_wahana").checked;
    let kodeCaptha = document.getElementById("captcha").value;
    let inputCaptcha = document.getElementById("input_captha").value;

    let namaError = document.getElementById("namaError");
    let deskripsiError = document.getElementById("deskripsiError");
    let kategoriError = document.getElementById("kategoriError");
    let subKategoriError = document.getElementById("subKategoriError");
    let hargaError = document.getElementById("hargaError");
    let grosirError = document.getElementById("grosirError");
    let hargaGrosirError = document.getElementById("hargaGrosirError");
    let jasaError = document.getElementById("jasaError");
    let capthaError = document.getElementById("capthaError");

    namaError.innerHTML = "";
    deskripsiError.innerHTML = "";
    kategoriError.innerHTML = "";
    subKategoriError.innerHTML = "";
    hargaError.innerHTML = "";
    grosirError.innerHTML = "";
    hargaGrosirError.innerHTML = "";
    jasaError.innerHTML = "";
    capthaError.innerHTML = "";

    let valid = true;

    // validasi nama produk
    if(namaProduk.trim() === ""){
        namaError.innerHTML = "*Nama Produk Tidak Boleh Kosong";
        valid = false;
    }else if (namaProduk.length < 5 || namaProduk.length > 30){
        namaError.innerHTML = "*Nama Produk Harus 5-30 Karakter";
        valid = false;
    }

    // validasi Deskripsi Produk
    if(deskripsiProduk.trim() === ""){
        deskripsiError.innerHTML = "*Deskripsi Tidak Boleh Kosong";
        valid = false;
    }else if (deskripsiProduk.length < 5 || deskripsiProduk.length > 100){
        deskripsiError.innerHTML = "*Deskripsi Harus 5-100 Karakter";
        valid = false;
    }

    // validasi Kategori
    if(kategoriProduk === ""){
        kategoriError.innerHTML = "*Pilih Kategori Produk";
        valid = false;
    }

    // validasi Sub Kategori
    if(subKategori === ""){
        subKategoriError.innerHTML = "*Pilih Sub Kategori";
        valid = false;
    }

    // validasi Harga Satuan
    if(hargaSatuan.trim() === ""){
        hargaError.innerHTML = "*Harga Satuan Tidak Boleh Kosong";
        valid = false;
    }

    // validasi Grosir
    if(!grosirYa && !grosirTidak){
        grosirError.innerHTML = "*Pilih Salah Satu Opsi";
        valid = false;
    }else if (grosirYa && hargaGrosir.trim() === ""){
        hargaGrosirError.innerHTML = "*Harga Grosir Harus Diisi Jika Memilih Ya";
        valid = false;
    }

    // validasi Jasa Kirim
    let jasaCount = 0;
    if(jasaJNE){
        jasaCount++;
    }
    if(jasaTIKI){
        jasaCount++;
    }
    if(jasaSiCepat){
        jasaCount++;
    }
    if(jasaNinja){
        jasaCount++;
    }
    if(jasaWahana){
        jasaCount++;
    }
    if(jasaCount < 3){
        jasaError.innerHTML = "*Minimal Jasa yang Dipilih Adalah 3";
        valid = false;
    }

    // validasi Captha
    if(inputCaptcha.trim() === ""){
        capthaError.innerHTML = "*Kode Captha Harus Diisi";
        valid = false;
    }else if (inputCaptcha !== kodeCaptha){
        capthaError.innerHTML = "*Kode Captha Tidak Sesuai";
        valid = false;
    }

    // Validasi Form
    if(valid){
        alert("Produk Berhasil Ditambahkan");
        document.getElementById("productForm").reset();
        document.getElementById("hrg_grosir").disabled = true;
    }
}  

// Fungsi Untuk mengaktifkan Input Harga Grosir
document.getElementById("grosir_ya").addEventListener('change', function() {
    document.getElementById("hrg_grosir").disabled = false;
});
document.getElementById("grosir_tidak").addEventListener('change', function() {
    document.getElementById("hrg_grosir").disabled = true;
});
