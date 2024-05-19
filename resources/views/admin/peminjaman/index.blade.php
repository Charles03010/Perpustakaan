@include('partials.header', ['title' => 'Dashboard Admin'])
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Peminjaman</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
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
                                                            class="badge rounded-pill {{ $item[0]->status == 'dipinjam' ? 'bg-warning' : 'bg-success' }}">{{ $item[0]->status }}</span>
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

    </main><!-- End #main -->
    @include('partials.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>
