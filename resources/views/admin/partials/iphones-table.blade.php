@forelse($iphones as $iphone)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 font-semibold text-gray-900">{{ $iphone->tipe_iphone }}</td>
    <td class="px-6 py-4 font-mono text-sm text-gray-900">{{ $iphone->imei }}</td>
    <td class="px-6 py-4">{{ $iphone->warna }}</td>
    <td class="px-6 py-4">
        @if($iphone->status == 'tersedia')
            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Tersedia</span>
        @elseif($iphone->status == 'disewa')
            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">Disewa</span>
        @elseif($iphone->status == 'maintenance')
            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Maintenance</span>
        @else
            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ ucfirst($iphone->status) }}</span>
        @endif
    </td>
    <td class="px-6 py-4">
        <span class="text-sm text-gray-900">{{ ucfirst($iphone->kondisi) }}</span>
    </td>
    <td class="px-6 py-4">
        <span class="font-semibold text-gray-900">Rp {{ number_format($iphone->harga_per_hari) }}</span>
    </td>
    <td class="px-6 py-4">
        @if($iphone->gambar)
            <img src="{{ $iphone->gambar }}" alt="gambar" class="w-14 h-14 object-cover rounded border border-gray-200">
        @else
            <span class="text-gray-400">-</span>
        @endif
    </td>
    <td class="px-6 py-4">
        <div class="flex space-x-2">
            <button onclick='editIphone(@json($iphone))' class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                <i class="fas fa-edit mr-1"></i>Edit
            </button>
            <form class="form-delete" action="{{ route('iphones.destroy', ['id_iphone' => $iphone->id_iphone]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center">
                    <i class="fas fa-trash mr-1"></i>Hapus
                </button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center py-8 text-gray-400">Data tidak ditemukan.</td>
</tr>
@endforelse