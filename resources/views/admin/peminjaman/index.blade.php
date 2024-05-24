@php
    if (auth()->user()->role == 'admin') {
        $role = 'admin';
    }
    $role = 'pengguna';
@endphp
@include('partials.header', ['title' => 'Dashboard ' . ucwords($role)])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('partials.topnav')

    @include('partials.sidebar', ['active' => 'peminjaman'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Peminjaman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route($role . '.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Peminjaman</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Scan Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="my-qr-reader">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div><!-- End Basic Modal-->
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Peminjaman</h5>
                                    <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-square"></i>
                                        Tambah Data
                                    </a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#basicModal">
                                        <i class="bi bi-camera-fill"></i>
                                        Scan Peminjaman
                                    </button>
                                    <!-- Table with hoverable rows -->
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="2">No.</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Judul</th>
                                                <th class="max-content" scope="col">Tanggal Pinjam</th>
                                                <th class="max-content" scope="col">Tanggal Kembali</th>
                                                <th class="max-content" scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($peminjaman as $item)
                                                <tr class="align-middle">
                                                    <td class="max-content" scope="row">{{ $loop->iteration }}</td>
                                                    <td class="max-content">
                                                        <form
                                                            action="{{ route('admin.peminjaman.destroy', $item[0]->id_peminjaman) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-3 p-2 rounded bg-danger me-2 border border-0">
                                                                <i class="bi bi-trash text-white"></i>
                                                            </button>
                                                            <a href="{{ route('admin.peminjaman.edit', $item[0]->id_peminjaman) }}"
                                                                class="w-3 p-2 rounded bg-warning me-2">
                                                                <i class="bi bi-pencil text-white"></i>
                                                            </a>
                                                            <a href="{{ route('admin.peminjaman.show', $item[0]->id_peminjaman) }}"
                                                                class="w-3 p-2 rounded bg-primary me-2">
                                                                <i class="bi bi-eye text-white"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                    <td>{{ $item[1]->nama }}</td>
                                                    <td>{{ $item[2]->judul }}</td>
                                                    <td>{{ $item[0]->tanggal_pinjam }}</td>
                                                    <td>{{ $item[0]->tanggal_kembali == '' ? '-' : $item[0]->tanggal_kembali }}
                                                    </td>
                                                    <td><span
                                                            class="badge rounded-pill {{ $item[0]->status == 'dipinjam' ? 'bg-warning' : ($item[0]->status == 'dikembalikan' ? 'bg-success' : ($item[0]->status == 'diajukan' ? 'bg-primary' : '')) }}">{{ $item[0]->status }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <!-- End Table with hoverable rows -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function domReady(fn) {
                if (
                    document.readyState === "complete" ||
                    document.readyState === "interactive"
                ) {
                    setTimeout(fn, 1000);
                } else {
                    document.addEventListener("DOMContentLoaded", fn);
                }
            }

            domReady(function() {
                function onScanSuccess(decodeText, decodeResult) {
                    $decoded = JSON.parse(decodeText);
                    window.location.replace(window.location.href+`/${$decoded.id_peminjaman}`+`/edit`);
                }
                let htmlscanner = new Html5QrcodeScanner(
                    "my-qr-reader", {
                        fps: 10,
                        qrbos: 250,
                    }
                );
                htmlscanner.render(onScanSuccess);
            });
        </script>
    </main><!-- End #main -->
    @include('partials.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>
