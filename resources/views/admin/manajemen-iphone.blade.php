@extends('layouts.admin')

@section('title', 'Manajemen iPhone')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Manajemen iPhone</h1>
            <button onclick="openIphoneModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Tambah iPhone
            </button>
        </div>

        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Tipe</th>
                        <th class="px-6 py-3 text-left">IMEI</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Kondisi</th>
                        <th class="px-6 py-3 text-left">Harga/Hari</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($iphones as $iphone)
                    <tr>
                        <td class="px-6 py-4">{{ $iphone->tipe_iphone }} ({{ $iphone->warna }})</td>
                        <td class="px-6 py-4">{{ $iphone->imei }}</td>
                        <td class="px-6 py-4">{{ ucfirst($iphone->status) }}</td>
                        <td class="px-6 py-4">{{ ucfirst($iphone->kondisi) }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($iphone->harga_per_hari) }}</td>
                        <td class="px-6 py-4">
                            <button onclick='viewIphone(@json($iphone))' class="text-sm text-blue-600">View</button>
                            <button onclick='editIphone(@json($iphone))' class="text-sm text-green-600 ml-2">Edit</button>
                            <form action="{{ route('iphones.destroy', ['id' => $iphone->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus iPhone ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="iphoneModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-xl relative">
        <h2 id="modalTitle" class="text-xl font-bold mb-4">Tambah iPhone</h2>
        <form id="iphoneForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="iphoneId" name="id">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Tipe iPhone</label>
                    <input type="text" name="tipe_iphone" id="tipe_iphone" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>IMEI</label>
                    <input type="text" name="imei" id="imei" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Warna</label>
                    <input type="text" name="warna" id="warna" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Status</label>
                    <select name="status" id="status" class="w-full border rounded p-2">
                        <option value="available">Tersedia</option>
                        <option value="rented">Disewa</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div>
                    <label>Kondisi</label>
                    <input type="text" name="kondisi" id="kondisi" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Harga per Hari</label>
                    <input type="number" name="harga_per_hari" id="harga_per_hari" class="w-full border rounded p-2">
                </div>
                <div class="col-span-2">
                    <label>Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="w-full">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('iphoneModal');
    const form = document.getElementById('iphoneForm');
    const title = document.getElementById('modalTitle');

    function openIphoneModal() {
        title.textContent = 'Tambah iPhone';
        form.action = '{{ route('iphones.store') }}';
        form.reset();
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    function editIphone(data) {
        title.textContent = 'Edit iPhone';
        form.action = '/admin/manajemen-iphone/' + data.id;
        form.querySelector('[name=_method]')?.remove();
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        form.appendChild(method);

        document.getElementById('iphoneId').value = data.id;
        document.getElementById('tipe_iphone').value = data.tipe_iphone;
        document.getElementById('imei').value = data.imei;
        document.getElementById('warna').value = data.warna;
        document.getElementById('status').value = data.status;
        document.getElementById('kondisi').value = data.kondisi;
        document.getElementById('harga_per_hari').value = data.harga_per_hari;

        modal.classList.remove('hidden');
    }

    function viewIphone(data) {
        editIphone(data);
        [...form.elements].forEach(el => el.readOnly = true);
        title.textContent = 'Detail iPhone';
        form.querySelector('button[type=submit]').style.display = 'none';
    }
</script>
@endpush
