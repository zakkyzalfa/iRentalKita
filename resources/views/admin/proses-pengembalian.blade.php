@extends('layouts.admin')

@section('title', 'Proses Pengembalian')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-8 mb-8">
        <div class="text-center">
            <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-undo text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pemeriksaan iPhone</h1>
            <p class="text-lg text-gray-800">Periksa kondisi iPhone dan proses pengembalian</p>
        </div>
    </div>
    <div class="max-w-6xl mx-auto px-8">
        <form action="{{ route('admin.proses-pengembalian.proses', $pemesanan->id_pemesanan) }}" method="POST" id="formPemeriksaan">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <!-- Kolom kiri: Info penyewa & rental -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user mr-3 text-gray-600"></i>
                            Data Penyewa & Rental
                        </h2>
                        <div class="space-y-4 mb-6">
                            <div class="text-center mb-4">
                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <span class="text-xl font-bold text-white">
                                        {{ strtoupper(substr($pemesanan->penyewa->nama,0,1)) }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $pemesanan->penyewa->nama }}</h3>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-900">{{ $pemesanan->penyewa->email }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="font-medium text-gray-900">{{ $pemesanan->penyewa->no_hp ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">No. KTP:</span>
                                <span class="font-medium text-gray-900">{{ $pemesanan->penyewa->no_ktp ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tipe iPhone:</span>
                                <span class="font-medium text-gray-900">{{ $pemesanan->iphone->tipe_iphone ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">IMEI:</span>
                                <span class="font-medium text-gray-900">{{ $pemesanan->iphone->imei ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Mulai:</span>
                                <span class="font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Kembali:</span>
                                <span class="font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_kembali)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Sewa:</span>
                                <span class="font-medium text-gray-900">Rp {{ number_format($durasi * $pemesanan->iphone->harga_per_hari,0,',','.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kolom kanan: Form pemeriksaan -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        <!-- Step 1: Pemeriksaan Kondisi -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    1
                                </div>
                                Pemeriksaan Kondisi iPhone
                            </h2>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-900 font-medium">Layar</label>
                                        <select name="kondisi_kembali[layar]" class="border border-gray-300 rounded px-2 py-1 text-sm kondisi" data-komponen="layar" required>
                                            <option value="baik" selected>Baik</option>
                                            <option value="rusak">Rusak</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-900 font-medium">Kamera</label>
                                        <select name="kondisi_kembali[kamera]" class="border border-gray-300 rounded px-2 py-1 text-sm kondisi" data-komponen="kamera" required>
                                            <option value="baik" selected>Baik</option>
                                            <option value="rusak">Rusak</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-900 font-medium">Body</label>
                                        <select name="kondisi_kembali[body]" class="border border-gray-300 rounded px-2 py-1 text-sm kondisi" data-komponen="body" required>
                                            <option value="baik" selected>Baik</option>
                                            <option value="rusak">Rusak</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-900 font-medium">Box iPhone</label>
                                        <select name="kondisi_kembali[kemasan]" class="border border-gray-300 rounded px-2 py-1 text-sm kondisi" data-komponen="kemasan" required>
                                            <option value="ada" selected>Ada</option>
                                            <option value="hilang">Hilang</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-900 font-medium">Charger</label>
                                        <select name="kondisi_kembali[charger]" class="border border-gray-300 rounded px-2 py-1 text-sm kondisi" data-komponen="charger" required>
                                            <option value="ada" selected>Ada</option>
                                            <option value="hilang">Hilang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2: Keterlambatan -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    2
                                </div>
                                Keterlambatan Pengembalian
                            </h2>
                            <div class="flex items-center gap-4">
                                <label for="keterlambatan_hari" class="block text-gray-900 font-medium">Keterlambatan (hari):</label>
                                <input type="number" min="0" name="keterlambatan_hari" id="keterlambatan_hari" value="{{ $keterlambatan }}" class="border border-gray-300 rounded px-2 py-1 text-sm w-24" required>
                                <span class="text-gray-600 text-sm">(Rp 600.000 / hari)</span>
                            </div>
                        </div>
                        <!-- Step 3: Perhitungan Denda Otomatis -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    3
                                </div>
                                Perhitungan Denda
                            </h2>
                            <div id="daftarDenda" class="mb-4 text-sm text-gray-800"></div>
                            <div class="flex justify-between items-center text-lg mt-6">
                                <span class="font-semibold text-gray-900">Total Denda:</span>
                                <input type="text" name="denda" id="totalDenda" class="border-0 bg-transparent text-right font-bold text-red-600 w-40" readonly value="0">
                            </div>
                        </div>
                        <!-- Step 4: Aksi -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 flex flex-col gap-4">
                            <button type="button" id="btn-pemeriksaan" class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-green-600 hover:text-green-600 border-2 border-green-600 transition-all duration-300">
                                <i class="fas fa-check mr-3"></i>
                                Pemeriksaan Selesai
                            </button>
                            <button type="submit" id="submit-pemeriksaan" class="hidden"></button>
                            <a href="{{ route('admin.dashboard-admin') }}" class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-red-600 hover:text-green-600 border-2 border-red-600 transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-times mr-3"></i>
                                Batalkan Proses
                            </a>
                        </div>
                        <div class="bg-gray-100 border border-gray-300 rounded-2xl p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-3"></i>
                                Catatan Penting untuk Petugas
                            </h2>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Periksa kondisi iPhone dengan teliti bersama penyewa</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Pastikan semua denda dibayar sebelum mengembalikan KTP</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Dokumentasikan kondisi iPhone dengan foto jika ada kerusakan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Update status iPhone menjadi "Tersedia" setelah pengembalian selesai</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const DENDA = {
    layar:    { rusak: 750000 },
    kamera:   { rusak: 500000 },
    body:     { rusak: 400000 },
    kemasan:  { hilang: 100000 },
    charger:  { hilang: 500000 }
};
const DENDA_TERLAMBAT_PER_HARI = 600000;

function hitungDenda() {
    let total = 0;
    let dendaList = [];

    // Komponen
    document.querySelectorAll('.kondisi').forEach(function(sel){
        const komponen = sel.dataset.komponen;
        const val = sel.value;
        if (DENDA[komponen] && DENDA[komponen][val]) {
            total += DENDA[komponen][val];
            let label = '';
            switch(komponen) {
                case 'layar': label = 'Layar Rusak'; break;
                case 'kamera': label = 'Kamera Rusak'; break;
                case 'body': label = 'Body Rusak'; break;
                case 'kemasan': label = 'Box/Hilang'; break;
                case 'charger': label = 'Charger Hilang'; break;
            }
            dendaList.push(`<li class="text-red-700">Denda ${label}: <b>Rp ${DENDA[komponen][val].toLocaleString('id-ID')}</b></li>`);
        }
    });

    // Keterlambatan
    const keterlambatan = parseInt(document.getElementById('keterlambatan_hari').value) || 0;
    if (keterlambatan > 0) {
        let dendaTerlambat = keterlambatan * DENDA_TERLAMBAT_PER_HARI;
        total += dendaTerlambat;
        dendaList.push(`<li class="text-red-700">Denda Keterlambatan ${keterlambatan} hari: <b>Rp ${dendaTerlambat.toLocaleString('id-ID')}</b></li>`);
    }

    document.getElementById('totalDenda').value = total.toLocaleString('id-ID');
    document.getElementById('daftarDenda').innerHTML = dendaList.length ? `<ul class="list-disc pl-5">${dendaList.join('')}</ul>` : '<span class="text-green-700">Tidak ada denda</span>';
}

// SweetAlert2 Pemeriksaan Selesai
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.kondisi').forEach(function(sel){
        sel.addEventListener('change', hitungDenda);
    });
    document.getElementById('keterlambatan_hari').addEventListener('input', hitungDenda);
    hitungDenda();

    document.getElementById('btn-pemeriksaan').addEventListener('click', function(){
        let totalDenda = parseInt(document.getElementById('totalDenda').value.replace(/\D/g, '')) || 0;
        let msg = totalDenda > 0
            ? "Penyewa dinyatakan denda, Apakah anda yakin?"
            : "Penyewa tidak dinyatakan denda, Apakah anda yakin?";
        Swal.fire({
            title: 'Konfirmasi Pemeriksaan',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('submit-pemeriksaan').click();
            }
        });
    });
});
</script>
@endpush