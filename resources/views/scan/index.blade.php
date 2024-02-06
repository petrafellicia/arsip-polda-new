@extends('layouts.main')

@section('container')
    <!-- Form Pemindaian -->
    <form action="/scan" method="POST">
        @csrf
        <button type="submit">Mulai Pemindaian</button>
    </form>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('/scan', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Lakukan sesuatu dengan data pemindaian, misalnya tampilkan gambar
                    console.log(data);
                });
        });
    </script>
@endsection
