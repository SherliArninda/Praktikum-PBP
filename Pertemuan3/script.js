// Fungsi untuk menampilkan/menghilangkan bagian Ekstrakurikuler
function toggleEkskul() {
    let kelas = document.getElementById("kelas").value;
    let ekskulSection = document.getElementById("ekskul-section");
    if (kelas === "XII") {
        ekskulSection.style.display = "none";
    } else {
        ekskulSection.style.display = "block";
    }
}
    
// Event listener untuk mengembalikan fungsi toggleEkskul saat tombol reset ditekan
document.querySelector('input[type="reset"]').addEventListener('click', function() {
    setTimeout(function() {
        toggleEkskul(); // Jalankan lagi setelah form di-reset
    }, 0); // Memastikan form telah di-reset sebelum menjalankan fungsi
});
    
// Panggil fungsi toggleEkskul untuk pertama kali saat halaman dimuat
toggleEkskul();
