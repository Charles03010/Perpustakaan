@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('partials.topnav')

    @include('partials.sidebar', ['active' => 'pengarang'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengarang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pengarang</li>
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
                                    <h5 class="card-title">Detail Data Pengarang</h5>
                                    <div class="d-flex align-items-start">
                                        <img class="w-25 me-3" src="{{ asset('storage/' . $pengarang->foto) }}"
                                            alt="Foto Pengarang">
                                        <dl class="row">
                                            <dt class="col-sm-3 mb-3">Nama</dt>
                                            <dd class="col-sm-9">{{ $pengarang->nama }}</dd>

                                            <dt class="col-sm-3 mb-3">Email</dt>
                                            <dd class="col-sm-9">{{ $pengarang->email }}</dd>

                                            <dt class="col-sm-3 mb-3">No Telepon</dt>
                                            <dd class="col-sm-9">{{ $pengarang->no_hp }}</dd>

                                            <dt class="col-sm-3 mb-3">Jenis Kelamin</dt>
                                            <dd class="col-sm-9">
                                                {{ $pengarang->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</dd>

                                            <dt class="col-sm-3 mb-3">Tempat, Tanggal Lahir</dt>
                                            <dd class="col-sm-9">
                                                {{ $pengarang->tempat_lahir . ', ' . date('d F Y', strtotime($pengarang->tanggal_lahir)) }}</dd>

                                            <dt class="col-sm-3 mb-3">Alamat</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $pengarang->alamat }}</p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Deskripsi</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $pengarang->deskripsi }}</p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Pendidikan Terakhir</dt>
                                            <dd class="col-sm-9">
                                                {{ $pengarang->pendidikan_terakhir == '' ? '-' : $pengarang->pendidikan_terakhir }}
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Riwayat Pendidikan</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $pengarang->riwayat_pendidikan == '' ? '-' : $pengarang->riwayat_pendidikan }}
                                                </p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Pekerjaan</dt>
                                            <dd class="col-sm-9">
                                                {{ $pengarang->pekerjaan == '' ? '-' : $pengarang->pekerjaan }}</dd>

                                            <dt class="col-sm-3 mb-3">Pengalaman Pekerjaan</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $pengarang->pengalaman_kerja == '' ? '-' : $pengarang->pengalaman_kerja }}
                                                </p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Riwayat Pekerjaan</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $pengarang->riwayat_kerja == '' ? '-' : $pengarang->riwayat_kerja }}
                                                </p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Penghargaan</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $pengarang->penghargaan == '' ? '-' : $pengarang->penghargaan }}</p>
                                            </dd>
                                        </dl>
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
