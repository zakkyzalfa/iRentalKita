@extends('layouts.app')

@section('title', 'Konfirmasi Pengambilan iPhone')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <!-- Progress Bar Stepper -->
    <div class="flex justify-center mb-8 mt-2">
        <ol class="flex items-center space-x-8">
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-800 text-white font-bold">1</div>
                <span class="ml-2 font-semibold text-gray-800">Pemesanan</span>
            </li>
            <li>
                <div class="w-10 h-0.5 bg-gray-800 mx-2"></div>
            </li>
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-800 text-white font-bold">2</div>
                <span class="ml-2 font-semibold text-gray-800">Pembayaran</span>
            </li>
            <li>
                <div class="w-10 h-0.5 bg-gray-800 mx-2"></div>
            </li>
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-800 text-white font-bold">3</div>
                <span class="ml-2 font-semibold text-gray-800">Ambil iPhone</span>
            </li>
        </ol>
    </div>

    <div class="max-w-4xl mx-auto px-8 mb-8">
        <div class="text-center">
            <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-hand-holding-heart text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Konfirmasi Pengambilan iPhone</h1>
            <p class="text-lg text-gray-800">Siap untuk mengambil iPhone Anda? Ikuti panduan di bawah ini</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-receipt mr-3 text-gray-600"></i>
                        Rincian Pemesanan
                    </h2>
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Nama Lengkap:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->penyewa->nama }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tipe iPhone:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->iphone->tipe_iphone }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">IMEI:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->iphone->imei }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Biaya Sewa Per Hari:</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($pemesanan->iphone->harga_per_hari,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tanggal Mulai:</span>
                            <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tanggal Kembali:</span>
                            <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($pemesanan->tanggal_kembali)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Durasi Sewa:</span>
                            <span class="font-medium text-gray-900">{{ $durasi }} hari</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Metode Pembayaran:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->pembayaran->metode_bayar }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($total,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Status Pembayaran:</span>
                            <span class="font-medium text-gray-900">{{ $status_pembayaran }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column - Pickup Information -->
            <div class="lg:col-span-3">
                <div class="space-y-6">
                    <!-- Persyaratan Pengambilan -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-clipboard-check mr-3 text-gray-600"></i>
                            Persyaratan Pengambilan
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-4 mt-0.5">1</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">KTP Asli</h3>
                                    <p class="text-sm text-gray-600">Bawa KTP asli sesuai data yang terdaftar</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-4 mt-0.5">2</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Bukti Pembayaran</h3>
                                    <p class="text-sm text-gray-600">Screenshot bukti pembayaran dan tunjukan ke petugas</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-4 mt-0.5">3</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Uang Tunai (Jika Bayar di Tempat)</h3>
                                    <p class="text-sm text-gray-600">Siapkan uang Tunai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Proses Pengambilan -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-list-ol mr-3 text-gray-600"></i>
                            Proses Pengambilan
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">1</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Datang ke Toko iRentalKita</h3>
                                    <p class="text-sm text-gray-600">Kunjungi Toko iRentalKita sesuai pada tanggal anda memulai sewa</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">2</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Menyerahkan Jaminan Anda</h3>
                                    <p class="text-sm text-gray-600">Serahkan KTP anda sebagai jaminan penyewaan</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">3</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Pengecekan iPhone</h3>
                                    <p class="text-sm text-gray-600">Cek kondisi iPhone bersama Petugas sebelum dibawa</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">4</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Pembayaran (Jika Belum)</h3>
                                    <p class="text-sm text-gray-600">Lakukan pembayaran jika anda memilih bayar di tempat</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">5</div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">iPhone Siap Dibawa</h3>
                                    <p class="text-sm text-gray-600">Terima iPhone dan nikmati!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Catatan Penting -->
                    <div class="bg-gray-100 border border-gray-300 rounded-2xl p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-3"></i>
                            Catatan Penting
                        </h2>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                <span>Anda wajib melakukan Konfirmasi dibawah jika anda telah menerima iPhone dan menyerahkan Jaminan KTP</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                <span>iPhone harus dikembalikan dalam kondisi baik sesuai tanggal yang sudah disepakati</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                <span>Jika terlambat mengembalikan, akan dikenakan denda Rp 600.000/hari</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                <span>Kerusakan atau kehilangan menjadi tanggung jawab penyewa (jika hilang, anda wajib menggantinya dengan yang baru)</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Tombol Aksi -->
                    <form id="formKonfirmasi" action="{{ route('konfirmasi.pengambilan.proses', $pemesanan->id_pemesanan) }}" method="POST">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-4 mt-6">
                            <button type="button" onclick="konfirmasiPengambilan()" class="flex-1 bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-green-600 hover:text-green-600 border-2 border-green-600 transition-all duration-300 flex items-center justify-center text-lg">
                                <i class="fas fa-check mr-3"></i>
                                Konfirmasi Pengambilan
                            </button>
                            <a href="{{ route('dashboard-penyewa') }}" class="flex-1 bg-gray-800 text-white py-3 px-4 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300 flex flex items-center justify-center text-lg">
                                <i class="fas fa-calendar-alt mr-3"></i>
                                Buka Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function konfirmasiPengambilan() {
    Swal.fire({
        title: 'Konfirmasi Pengambilan?',
        html: 'Lakukan konfirmasi ini jika anda telah menyerahkan KTP anda, telah melakukan pembayaran, dan iPhone telah di tangan anda.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form secara AJAX agar bisa menampilkan SweetAlert2 setelah submit
            var form = document.getElementById('formKonfirmasi');
            var action = form.action;
            var csrf = form.querySelector('input[name="_token"]').value;

            fetch(action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': csrf
                },
                body: ''
            })
            .then(response => {
                // Tampilkan alert sukses jika status 200/302
                Swal.fire({
                    icon: 'success',
                    title: 'Pengambilan iPhone Berhasil',
                    html: 'Selamat menikmati iPhone yang anda sewa.<br>Mohon untuk kembalikan iPhone pada tanggal yang telah disepakati.',
                    confirmButtonText: 'Oke'
                }).then(() => {
                    // Redirect ke dashboard penyewa (atau sesuai kebutuhan)
                    window.location.href = "{{ route('dashboard-penyewa') }}";
                });
            });
        }
    });
}
</script>
@endpush