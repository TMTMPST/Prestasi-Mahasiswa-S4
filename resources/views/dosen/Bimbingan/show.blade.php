<!-- Modal Trigger Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bimbinganModal">
    Lihat Data Bimbingan
</button>

<!-- Modal -->
<div class="modal fade" id="bimbinganModal" tabindex="-1" aria-labelledby="bimbinganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bimbinganModalLabel">Data Bimbingan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(isset($bimbingan) && count($bimbingan) > 0)
                    <form>
                        @foreach($bimbingan as $item)
                            <div class="mb-3">
                                <label class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" value="{{ $item->mahasiswa->nama ?? '-' }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Bimbingan</label>
                                <input type="text" class="form-control" value="{{ $item->judul ?? '-' }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="text" class="form-control" value="{{ $item->tanggal ?? '-' }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" rows="2" readonly>{{ $item->catatan ?? '-' }}</textarea>
                            </div>
                            <hr>
                        @endforeach
                    </form>
                @else
                    <p>Tidak ada data bimbingan.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>