@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('partials.topnav')

    @include('partials.sidebar', ['active' => 'skripsi'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Skripsi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Skripsi</li>
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
                                    <h5 class="card-title">Detail Data Skripsi</h5>
                                    <div class="d-flex align-items-start">
                                        <dl class="row">
                                            
                                            <dt class="col-sm-3 mb-3">Status</dt>
                                            <dd class="col-sm-9"><h3
                                                class="badge rounded-pill bg-{{ $skripsi->status == 'pending' ? 'warning' : ($skripsi->status == 'diterima' ? 'success' : ($skripsi->status == 'ditolak' ? 'danger' : '')) }}">
                                                {{ $skripsi->status }}
                                            </h3></dd>
                                            
                                            <dt class="col-sm-3 mb-3">Judul</dt>
                                            <dd class="col-sm-9">{{ $repo->judul }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Pengarang</dt>
                                            <dd class="col-sm-9">{{ $pengarang->nama }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Penerbit</dt>
                                            <dd class="col-sm-9">{{ $penerbit->nama_penerbit }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Kategori</dt>
                                            <dd class="col-sm-9">{{ $kategori->nama_kategori }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Prodi</dt>
                                            <dd class="col-sm-9">{{ $prodi->nama_prodi }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Fakultas</dt>
                                            <dd class="col-sm-9">{{ $fakultas->nama_fakultas }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Pembimbing</dt>
                                            <dd class="col-sm-9">{{ $skripsi->pembimbing }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Penguji</dt>
                                            <dd class="col-sm-9">{{ $skripsi->penguji }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Tahun Terbit</dt>
                                            <dd class="col-sm-9">{{ $repo->tahun_terbit }}</dd>
                                            
                                            <dt class="col-sm-3 mb-3">Deskripsi</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $repo->deskripsi }}</p>
                                            </dd>
                                        </dl>
                                    </div>
                                    <a class="btn btn-primary" href="{!! route('admin.download', $skripsi->file) !!}">Unduh Skripsi</a>
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
