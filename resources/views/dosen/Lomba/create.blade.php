<style>
    /* Color Variables */
    :root {
        --primary: #0c1e47;
        --secondary: #f7b71d;
        --accent1: #f26430;
        --accent2: #f9a11b;
        --accent3: #e6e6e6;
        --light: #ffffff;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
    }

    /* General Body Styling */
    body {
        background: var(--accent3);
    }

    /* Custom Backgrounds */
    .custom-bg-primary {
        background-color: var(--primary) !important;
        color: var(--light) !important;
    }

    /* Custom Buttons */
    .custom-btn-primary {
        background-color: var(--primary) !important;
        border: none !important;
        color: var(--secondary) !important;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(12, 30, 71, 0.15);
        transition: box-shadow 0.2s;
    }

    .custom-btn-primary:hover {
        background-color: var(--secondary) !important;
        color: var(--primary) !important;
        box-shadow: 0 4px 16px rgba(12, 30, 71, 0.25);
        opacity: 0.95;
    }

    .custom-btn-secondary {
        background-color: var(--secondary) !important;
        color: var(--primary) !important;
        font-weight: 600;
        border: none;
    }

    .custom-btn-secondary:hover {
        background-color: var(--accent1) !important;
        color: var(--light) !important;
    }

    /* Form Controls */
    .custom-form-control:focus {
        border-color: var(--accent1);
        box-shadow: 0 0 0 0.2rem rgba(242, 100, 48, 0.15);
    }

    .custom-label {
        color: var(--primary);
        font-weight: 500;
    }

    .form-control.custom-form-control,
    .form-select.custom-form-control {
        border: 1px solid var(--gray);
        background-color: var(--light-gray);
        color: var(--dark);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control.custom-form-control:focus,
    .form-select.custom-form-control:focus {
        border-color: var(--accent1);
        box-shadow: 0 0 0 0.2rem rgba(242, 100, 48, 0.15);
        background-color: var(--light);
    }

    /* File Input Specific Styling */
    input[type="file"].custom-form-control {
        border: 1px solid var(--gray);
        background-color: var(--light-gray);
        color: var(--dark);
        padding: 0.375rem 0.75rem;
    }

    input[type="file"].custom-form-control::file-selector-button {
        background: var(--primary);
        color: var(--secondary);
        border: none;
        padding: 0.5em 1em;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }

    input[type="file"].custom-form-control::file-selector-button:hover {
        background: var(--accent1);
        color: var(--light);
    }
</style>

<form id="formTambahLomba" method="POST" action="{{ route('lomba.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="modal-header custom-bg-primary text-center">
        <h5 class="modal-title w-100">Tambah Lomba</h5>
    </div>

    <div class="modal-body">
        <div class="mb-3">
            <label for="namaLomba" class="form-label custom-label">Nama Lomba</label>
            <input type="text" class="form-control custom-form-control" id="namaLomba" name="nama_lomba" required placeholder="Contoh: Lomba Internal Competition">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tingkatLomba" class="form-label custom-label">Tingkat</label>
                <select class="form-select custom-form-control" id="tingkatLomba" name="tingkat" required>
                    <option value="">Pilih Tingkat</option>
                    @foreach($tingkats as $tingkat)
                        <option value="{{ $tingkat->id }}">{{ $tingkat->nama_tingkat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tingkatPenyelenggara" class="form-label custom-label">Tingkat Penyelenggara</label>
                <select class="form-select custom-form-control" id="tingkatPenyelenggara" name="tingkat_penyelenggara" required>
                    <option value="">Pilih Tingkat Penyelenggara</option>
                    {{-- These options should match the actual strings you want to store --}}
                    <option value="Kampus Lain / Organisasi Mahasiswa Nasional">Kampus Lain / Organisasi Mahasiswa Nasional</option>
                    <option value="Pemerintah Daerah">Pemerintah Daerah</option>
                    <option value="Organisasi Internasional/Swasta">Organisasi Internasional/Swasta</option>
                    <option value="UKM Universitas">UKM Universitas</option>
                    <option value="Lembaga Pemerintah">Lembaga Pemerintah</option>
                    {{-- Add any other relevant fixed options here --}}
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jenisLomba" class="form-label custom-label">Jenis</label>
                <select class="form-select custom-form-control" id="jenisLomba" name="jenis" required>
                    <option value="">Pilih Jenis</option>
                    @foreach($jeniss as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="penyelenggaraLomba" class="form-label custom-label">Penyelenggara</label>
                <input type="text" class="form-control custom-form-control" id="penyelenggaraLomba" name="penyelenggara" required placeholder="Contoh: Universitas Brawijaya">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tglDibuka" class="form-label custom-label">Tanggal Dibuka (Pendaftaran)</label>
                <input type="date" class="form-control custom-form-control" id="tglDibuka" name="tgl_dibuka" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tglDitutup" class="form-label custom-label">Tanggal Ditutup (Pendaftaran)</label>
                <input type="date" class="form-control custom-form-control" id="tglDitutup" name="tgl_ditutup" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="alamatLomba" class="form-label custom-label">Alamat / Lokasi Lomba</label>
            <input type="text" class="form-control custom-form-control" id="alamatLomba" name="alamat" required placeholder="Contoh: Jl. Veteran No. 1, Malang / Online">
        </div>

        <div class="mb-3">
            <label for="biayaLomba" class="form-label custom-label">Biaya Pendaftaran (Rp)</label>
            <input type="number" class="form-control custom-form-control" id="biayaLomba" name="biaya" placeholder="Contoh: 0 (Gratis) atau 50000">
        </div>

        <div class="mb-3">
            <label for="hadiahLomba" class="form-label custom-label">Hadiah Lomba</label>
            <input type="text" class="form-control custom-form-control" id="hadiahLomba" name="hadiah" placeholder="Contoh: Rp 10.000.000 / Medali & Sertifikat">
        </div>

        <div class="mb-3">
            <label for="linkLomba" class="form-label custom-label">Link Lomba</label>
            <input type="url" class="form-control custom-form-control" id="linkLomba" name="link_lomba" placeholder="https://contoh.com/lomba">
        </div>

        <div class="mb-3">
            <label for="fileLomba" class="form-label custom-label">Upload File (Poster/Panduan)</label>
            <input type="file" class="form-control custom-form-control" id="fileLomba" name="file_lomba" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn custom-btn-primary">Simpan</button>
        <button type="button" class="btn custom-btn-secondary" data-coreui-dismiss="modal">Batal</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formTambahLomba = document.getElementById('formTambahLomba');

        if (formTambahLomba) {
            formTambahLomba.addEventListener('submit', async (e) => {
                e.preventDefault(); // Prevent default form submission

                const form = e.target;
                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ensure you have a CSRF token meta tag in your head
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        const modalElement = document.getElementById('modalTambahLomba');
                        if (modalElement) {
                            const modal = coreui.Modal.getInstance(modalElement);
                            modal.hide();
                        }

                        alert('Lomba berhasil ditambahkan!');
                        location.reload(); // Reload page to reflect new data
                    } else {
                        // Handle server-side validation errors or other non-OK responses
                        const errorMessage = result.message || 'Terjadi kesalahan saat menyimpan data.';
                        alert(errorMessage);
                        console.error('Server error:', result);
                    }
                } catch (error) {
                    alert('Terjadi kesalahan jaringan atau tak terduga.');
                    console.error('Fetch error:', error);
                }
            });
        }
    });
</script>