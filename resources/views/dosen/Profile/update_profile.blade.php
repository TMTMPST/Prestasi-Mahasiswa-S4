@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Update Profil Dosen</strong>
        </div>
        <div class="card-body">
<form action="{{ route('dosen.profile.update', $dosen->nip) }}" method="POST">                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $dosen->nip) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dosen->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $dosen->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="DSN" {{ old('level', $dosen->level) == 'DSN' ? 'selected' : '' }}>DSN</option>
                        <option value="MHS" {{ old('level', $dosen->level) == 'MHS' ? 'selected' : '' }}>MHS</option>
                        <option value="ADM" {{ old('level', $dosen->level) == 'ADM' ? 'selected' : '' }}>ADM</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bidangMinat" class="form-label">Bidang Minat</label>
                    <select class="form-control" id="bidangMinat" name="bidangMinat">
                        <option value="">-- Pilih Bidang Minat --</option>
                        <option value="Software Engineering / Product Design" {{ old('bidangMinat', $dosen->bidangMinat) == 'Software Engineering / Product Design' ? 'selected' : '' }}>Software Engineering / Product Design</option>
                        <option value="Web Development" {{ old('bidangMinat', $dosen->bidangMinat) == 'Web' ? 'selected' : '' }}>Web</option>
                        <option value="Mobile App Development" {{ old('bidangMinat', $dosen->bidangMinat) == 'Mobile App Development' ? 'selected' : '' }}>Mobile App Development</option>
                        <option value="Game Development" {{ old('bidangMinat', $dosen->bidangMinat) == 'Game Development' ? 'selected' : '' }}>Game Development</option>
                        <option value="Smart City Innovation" {{ old('bidangMinat', $dosen->bidangMinat) == 'Smart City Innovation' ? 'selected' : '' }}>Smart City Innovation</option>
                        <option value="Startup Pitch / Technopreneurship" {{ old('bidangMinat', $dosen->bidangMinat) == 'Startup Pitch / Technopreneurship' ? 'selected' : '' }}>Startup Pitch / Technopreneurship</option>
                        <option value="Hackathon" {{ old('bidangMinat', $dosen->bidangMinat) == 'Hackathon' ? 'selected' : '' }}>Hackathon</option>
                        <option value="Design Thinking Challenge" {{ old('bidangMinat', $dosen->bidangMinat) == 'Design Thinking Challenge' ? 'selected' : '' }}>Design Thinking Challenge</option>
                        <option value="Artificial Intelligence (AI)" {{ old('bidangMinat', $dosen->bidangMinat) == 'Artificial Intelligence (AI)' ? 'selected' : '' }}>Artificial Intelligence (AI)</option>
                        <option value="Machine Learning (ML)" {{ old('bidangMinat', $dosen->bidangMinat) == 'Machine Learning (ML)' ? 'selected' : '' }}>Machine Learning (ML)</option>
                        <option value="Big Data" {{ old('bidangMinat', $dosen->bidangMinat) == 'Big Data' ? 'selected' : '' }}>Big Data</option>
                        <option value="Data Science Challenge" {{ old('bidangMinat', $dosen->bidangMinat) == 'Data Science Challenge' ? 'selected' : '' }}>Data Science Challenge</option>
                        <option value="Ethical Hacking" {{ old('bidangMinat', $dosen->bidangMinat) == 'Ethical Hacking' ? 'selected' : '' }}>Ethical Hacking</option>
                        <option value="CTF (Capture The Flag)" {{ old('bidangMinat', $dosen->bidangMinat) == 'CTF (Capture The Flag)' ? 'selected' : '' }}>CTF (Capture The Flag)</option>
                        <option value="Digital Forensics" {{ old('bidangMinat', $dosen->bidangMinat) == 'Digital Forensics' ? 'selected' : '' }}>Digital Forensics</option>
                        <option value="Cloud Computing" {{ old('bidangMinat', $dosen->bidangMinat) == 'Cloud Computing' ? 'selected' : '' }}>Cloud Computing</option>
                        <option value="Internet of Things (IoT)" {{ old('bidangMinat', $dosen->bidangMinat) == 'Internet of Things (IoT)' ? 'selected' : '' }}>Internet of Things (IoT)</option>
                        <option value="UI/UX" {{ old('bidangMinat', $dosen->bidangMinat) == 'UI/UX' ? 'selected' : '' }}>UI/UX</option>
                        <option value="Poster Digital / Infografis" {{ old('bidangMinat', $dosen->bidangMinat) == 'Poster Digital / Infografis' ? 'selected' : '' }}>Poster Digital / Infografis</option>
                        <option value="Board Game Design" {{ old('bidangMinat', $dosen->bidangMinat) == 'Board Game Design' ? 'selected' : '' }}>Board Game Design</option>
                        <option value="Short Movie / Film Pendek" {{ old('bidangMinat', $dosen->bidangMinat) == 'Short Movie / Film Pendek' ? 'selected' : '' }}>Short Movie / Film Pendek</option>
                        <option value="Fotografi / Videografi" {{ old('bidangMinat', $dosen->bidangMinat) == 'Fotografi / Videografi' ? 'selected' : '' }}>Fotografi / Videografi</option>
                        <option value="Senam Kreasi / Tari Tradisional" {{ old('bidangMinat', $dosen->bidangMinat) == 'Senam Kreasi / Tari Tradisional' ? 'selected' : '' }}>Senam Kreasi / Tari Tradisional</option>
                        <option value="Pidato / Debat Bahasa Inggris / Indonesia" {{ old('bidangMinat', $dosen->bidangMinat) == 'Pidato / Debat Bahasa Inggris / Indonesia' ? 'selected' : '' }}>Pidato / Debat Bahasa Inggris / Indonesia</option>
                        <option value="Lomba Karya Tulis Ilmiah (LKTI)" {{ old('bidangMinat', $dosen->bidangMinat) == 'Lomba Karya Tulis Ilmiah (LKTI)' ? 'selected' : '' }}>Lomba Karya Tulis Ilmiah (LKTI)</option>
                        <option value="Competitive Programming / Speed Programming" {{ old('bidangMinat', $dosen->bidangMinat) == 'Competitive Programming / Speed Programming' ? 'selected' : '' }}>Competitive Programming / Speed Programming</option>
                        <option value="Augmented Reality / Virtual Reality (AR/VR)" {{ old('bidangMinat', $dosen->bidangMinat) == 'Augmented Reality / Virtual Reality (AR/VR)' ? 'selected' : '' }}>Augmented Reality / Virtual Reality (AR/VR)</option>
                        <option value="E-sport" {{ old('bidangMinat', $dosen->bidangMinat) == 'E-sport' ? 'selected' : '' }}>E-sport</option>
                        <option value="Sport" {{ old('bidangMinat', $dosen->bidangMinat) == 'Sport' ? 'selected' : '' }}>Sport</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('dosen.profile.index') }}" class="btn btn-secondary">Batal</a>            </form>
        </div>
    </div>
</div>
@endsection