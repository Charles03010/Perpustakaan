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
                                    <h5 class="card-title">
                                        {{ empty($peminjaman) ? 'Tambah Data Peminjaman' : 'Edit Data Peminjaman' }}
                                    </h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" action="{{ route('admin.peminjaman.store') }}" method="POST">
                                        @csrf
                                        @if ($errors->any())
                                            <div
                                                class="alert alert-danger alert-dismissible fade show d-flex align-items-center">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="id_pengguna"
                                                    list="id_penggunas" placeholder="Nama peminjaman" name="id_pengguna"
                                                    value="{{ empty($peminjaman) ? old('id_pengguna') : $peminjaman->id_pengguna }}"
                                                    required>
                                                <label for="id_pengguna">Nama peminjaman</label>
                                                <datalist id="id_penggunas">
                                                    @foreach ($pengguna as $item)
                                                        <option value="{{ $item->id_pengguna }} - {{ $item->nama }}">
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="id_repositori"
                                                    list="id_repos" placeholder="Nama peminjaman" name="id_repositori"
                                                    value="{{ empty($peminjaman) ? old('id_repositori') : $peminjaman->id_repositori }}"
                                                    required>
                                                <label for="id_repositori">Judul</label>
                                                <datalist id="id_repos">
                                                    @foreach ($repo as $item)
                                                        <option
                                                            value="{{ $item->id_repositori }} - {{ $item->judul }}">
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="tanggal_pinjam"
                                                    placeholder="Tanggal Lahir Pengarang" name="tanggal_pinjam" required
                                                    value="{{ empty($peminjaman) ? old('tanggal_pinjam') : $peminjaman->tanggal_pinjam }}">
                                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="tanggal_kembali"
                                                    placeholder="Tanggal Lahir Pengarang" name="tanggal_kembali"
                                                    value="{{ empty($peminjaman) ? old('tanggal_kembali') : $peminjaman->tanggal_kembali }}">
                                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Keterangan peminjaman" id="floatingTextarea" style="height: 100px;" required
                                                    name="keterangan">{{ empty($peminjaman) ? old('keterangan') : $peminjaman->keterangan }}</textarea>
                                                <label for="floatingTextarea">Keterangan peminjaman</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State"
                                                    name="status" required>
                                                    <option value="" hidden>Pilih Status</option>
                                                    <option value="dipinjam"
                                                        <?= (empty($peminjaman) ? old('status') : $peminjaman->status) == 'dipinjam' ? 'selected' : '' ?>>
                                                        Dipinjam</option>
                                                    <option value="dikembalikan"
                                                        <?= (empty($peminjaman) ? old('status') : $peminjaman->status) == 'dikembalikan' ? 'selected' : '' ?>>
                                                        Dikembalikan</option>
                                                </select>
                                                <label for="floatingSelect">Status</label>
                                            </div>
                                        </div>
                                        @isset($peminjaman)
                                            @empty(!$peminjaman)
                                                <input type="hidden" name="id_peminjaman"
                                                    value="{{ $peminjaman->id_peminjaman }}">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="denda"
                                                            placeholder="Denda" name="denda"
                                                            value="{{ empty($peminjaman) ? old('denda') : $peminjaman->denda }}">
                                                        <label for="denda">Denda</label>
                                                    </div>
                                                </div>
                                            @endempty
                                        @endisset
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form><!-- End floating Labels Form -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @include('partials.footer')
    <script>
        document.getElementById('tanggal_pinjam').valueAsDate = new Date();
    </script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>
