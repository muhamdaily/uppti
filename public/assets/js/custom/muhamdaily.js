// Mendapatkan elemen dengan ID "tanggal" dan "jam"
var tanggalElement = document.getElementById('tanggal');
var jamElement = document.getElementById('jam');

// Fungsi untuk mengupdate waktu setiap detik
function updateWaktu() {
    var tanggalSekarang = new Date();
    var hari = tanggalSekarang.getDay();
    var tanggal = tanggalSekarang.getDate();
    var bulan = tanggalSekarang.getMonth() + 1;
    var tahun = tanggalSekarang.getFullYear();
    var jam = padZero(tanggalSekarang.getHours());
    var menit = padZero(tanggalSekarang.getMinutes());
    var detik = padZero(tanggalSekarang.getSeconds());

    var formatHari = getHariIndonesia(hari);
    var formatTanggal = formatHari + ', ' + tanggal + ' ' + getBulanIndonesia(bulan) + ' ' + tahun;
    var formatJam = jam + ':' + menit + ':' + detik;

    // Simpan jam dan tanggal saat ini ke localStorage
    localStorage.setItem('tanggal', formatTanggal);
    localStorage.setItem('jam', formatJam);

    tanggalElement.innerHTML = formatTanggal;
    jamElement.innerHTML = formatJam;
}

// Memanggil fungsi updateWaktu setiap detik
setInterval(updateWaktu, 1000);

// Saat halaman pertama kali dimuat, periksa apakah ada data di localStorage
document.addEventListener("DOMContentLoaded", function () {
    var storedTanggal = localStorage.getItem('tanggal');
    var storedJam = localStorage.getItem('jam');

    if (storedTanggal && storedJam) {
        // Jika ada data di localStorage, gunakan data tersebut
        tanggalElement.innerHTML = storedTanggal;
        jamElement.innerHTML = storedJam;
    } else {
        // Jika tidak ada, panggil updateWaktu untuk menginisialisasi jam dan tanggal
        updateWaktu();
    }
});

// Fungsi untuk menambahkan angka nol di depan angka tunggal (misalnya, 1 menjadi 01)
function padZero(angka) {
    return (angka < 10 ? '0' : '') + angka;
}

// Fungsi untuk mendapatkan nama bulan dalam bahasa Indonesia berdasarkan angka bulan
function getBulanIndonesia(bulan) {
    var namaBulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    return namaBulan[bulan - 1];
}

// Fungsi untuk mendapatkan nama hari dalam bahasa Indonesia berdasarkan angka hari
function getHariIndonesia(hari) {
    var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    return namaHari[hari];
}
