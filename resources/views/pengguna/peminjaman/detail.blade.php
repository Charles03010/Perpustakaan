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
                                    <h5 class="card-title">Detail Data Peminjaman</h5>
                                    <div class="d-flex align-items-start">
                                        <dl class="row">
                                            <dt class="col-sm-3 mb-3">Status</dt>
                                            <dd class="col-sm-9">
                                                <h3
                                                    class="badge rounded-pill bg-{{ $peminjaman->status == 'dipinjam' ? 'warning' : ($peminjaman->status == 'dikembalikan' ? 'success' : ($peminjaman->status == 'diajukan' ? 'primary' : '')) }}">
                                                    {{ $peminjaman->status }}
                                                </h3>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Nama Peminjam</dt>
                                            <dd class="col-sm-9">{{ $pengguna->nama }}</dd>

                                            <dt class="col-sm-3 mb-3">Judul</dt>
                                            <dd class="col-sm-9">{{ $repositori->judul }}</dd>

                                            <dt class="col-sm-3 mb-3">Tanggal Pinjam</dt>
                                            <dd class="col-sm-9">{{ $peminjaman->tanggal_pinjam  == '' ? '-' : $peminjaman->tanggal_pinjam}}</dd>

                                            <dt class="col-sm-3 mb-3">Tanggal Kembali</dt>
                                            <dd class="col-sm-9">
                                                {{ $peminjaman->tanggal_kembali == '' ? '-' : $peminjaman->tanggal_kembali }}
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Keterangan</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $peminjaman->keterangan }}</p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Denda</dt>
                                            <dd class="col-sm-9">
                                                {{ $peminjaman->denda == '' ? '-' : 'Rp. ' . number_format($peminjaman->denda, 0, ',', '.') }}
                                            </dd>

                                        </dl>
                                        {!! $qr !!}
                                    </div>
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
