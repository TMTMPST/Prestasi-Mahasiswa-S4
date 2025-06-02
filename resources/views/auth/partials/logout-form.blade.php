<form id="logout-form" action="{{ route('logout') }}" method="POST" class="m-0 p-0">
    @csrf
    <button type="submit" id="logout-btn" class="dropdown-item text-danger">Logout</button>
</form>
<script>
document.getElementById('logout-form').addEventListener('submit', function(e) {
    e.preventDefault();
    if (confirm('Apakah Anda yakin ingin logout?')) {
        const btn = document.getElementById('logout-btn');
        btn.disabled = true;
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (response.ok) {
                window.location.href = "{{ route('login') }}";
            } else {
                alert('Logout gagal.');
                btn.disabled = false;
            }
        })
        .catch(() => {
            alert('Logout gagal.');
            btn.disabled = false;
        });
    }
});
</script>