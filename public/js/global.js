// home.js

let isLoggedIn = false;

function toggleLoginState() {
    isLoggedIn = !isLoggedIn;
    updateHeaderDisplay();
}

function updateHeaderDisplay() {
    const headerNotLoggedIn = document.getElementById('headerNotLoggedIn');
    const headerLoggedIn = document.getElementById('headerLoggedIn');

    if (isLoggedIn) {
        headerNotLoggedIn.classList.add('hidden');
        headerLoggedIn.classList.remove('hidden');
    } else {
        headerNotLoggedIn.classList.remove('hidden');
        headerLoggedIn.classList.add('hidden');
    }
}


// Navigasi global untuk header
function goToBeranda() {
    window.location.href = '/';
}

function goToDaftarIphone() {
    window.location.href = '/daftar-iphone';
}

function goToLoginPenyewa() {
    window.location.href = '/login-penyewa';
}

function goToRegister() {
    window.location.href = '/pendaftaran';
}

function goToDashboardPenyewa() {
    window.location.href = '/dashboard';
}

function goToLoginAdmin() {
    window.location.href = "/login-admin";
}

// Confirm pickup
function goToKonfirmasiPengembalian() {
    window.location.href = '/konfirmasi-pengembalian';
}




// Navigation functions
function goToDashboard() {
    window.location.href = '/admin/dashboard-admin';
}

function goToManajemenIphone() {
    window.location.href = '/admin/manajemen-iphone';
}

function goToManajemenPenyewa() {
    window.location.href = '/admin/manajemen-penyewa';
}

function goToTambahIphone() {
    window.location.href = '/admin/tambah-iphone';
}

function goToLaporan() {
    window.location.href = '/admin/laporan';
}








function rentIphone(iphoneModel) {
    if (isLoggedIn) {
        alert(`Mengarahkan ke halaman pemesanan untuk ${iphoneModel}...`);
        window.location.href = '/detail-iphone';
    } else {
        if (confirm(`Anda perlu login terlebih dahulu untuk menyewa ${iphoneModel}. Login sekarang?`)) {
            goToLoginPenyewa();
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateHeaderDisplay();
});
