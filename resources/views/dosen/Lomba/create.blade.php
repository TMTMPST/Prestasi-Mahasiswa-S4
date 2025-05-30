<style>
    .custom-bg-primary {
        background-color: #f15a29 !important;
        color: #fff !important;
    }
    .custom-btn-primary {
        background-color: #f15a29 !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600;
        transition: box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(241,90,41,0.15);
    }
    .custom-btn-primary:hover {
        box-shadow: 0 4px 16px rgba(241,90,41,0.25);
        opacity: 0.95;
    }
    .custom-btn-secondary {
        background-color: #141ee4 !important;
        color: #fff !important;
        font-weight: 600;
        border: none;
    }
    .custom-btn-secondary:hover {
        opacity: 0.95;
    }
    .custom-label {
        color: #f15a29 !important;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .custom-form-control {
        border-radius: 8px;
        border: 1.5px solid #e0e0e0;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .custom-form-control:focus {
        border-color: #f15a29;
        box-shadow: 0 0 0 0.2rem rgba(241,90,41,.15);
    }
</style>

<form id="formTambahLomba" method="POST" action="{{ route('lomba.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-header custom-bg-primary text-center">
        <h5 class="modal-title w-100">Tambah Lomba</h5>
    </div>


    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label custom-label">Nama Lomba</label>
            <input type="text" class="form-control custom-form-control" name="nama_lomba" required placeholder="Lomba Internal competition">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label custom-label">Tingkat</label>
                <select class="form-select custom-form-control" name="tingkat_id" required>
                    <option value="">Pilih Tingkat</option>
                    @foreach($tingkats as $tingkat)
                    <option value="{{ $tingkat->id }}">{{ $tingkat->nama_tingkat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label custom-label">Kategori</label>
                <select class="form-select custom-form-control" name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label custom-label">Jenis</label>
                <select class="form-select custom-form-control" name="jenis_id" required>
                    <option value="">Pilih Jenis</option>
                    @foreach($jeniss as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label custom-label">Penyelenggara</label>
                <input type="text" class="form-control custom-form-control" name="penyelenggara" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label custom-label">Tanggal Mulai</label>
                <input type="date" class="form-control custom-form-control" name="tanggal_mulai" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label custom-label">Tanggal Selesai</label>
                <input type="date" class="form-control custom-form-control" name="tanggal_selesai" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label custom-label">Upload File</label>
            <input type="file" class="form-control custom-form-control" name="file_lomba" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn custom-btn-primary">Simpan</button>
        <button type="button" class="btn custom-btn-secondary" data-coreui-dismiss="modal">Batal</button>
    </div>
</form>


<script>
document.addEventListener('submit', function (e) {
    if (e.target && e.target.id === 'formTambahLomba') {
        e.preventDefault();

        let form = e.target;
        let data = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: data
        })
        .then(res => res.json())
        .then(response => {
            // Tutup modal, refresh tabel, atau tampilkan pesan
            const modal = coreui.Modal.getInstance(document.getElementById('modalTambahLomba'));
            modal.hide();

            alert('Lomba berhasil ditambahkan!');
            location.reload(); // atau kamu bisa panggil AJAX untuk refresh data tabel
        })
        .catch(error => {
            alert('Terjadi kesalahan saat menyimpan data.');
            console.error(error);
        });
    }
});
</script>



