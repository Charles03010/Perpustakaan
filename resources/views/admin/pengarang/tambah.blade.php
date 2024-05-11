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
                                    <h5 class="card-title">
                                        {{ empty($pengarang) ? 'Tambah Data Pengarang' : 'Edit Data Pengarang' }}</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" action="{{ route('admin.pengarang.store') }}" method="POST" enctype="multipart/form-data">
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
                                        @isset($pengarang)
                                            @empty(!$pengarang)
                                                <input type="hidden" name="id_pengarang"
                                                    value="{{ $pengarang->id_pengarang }}">
                                            @endempty
                                        @endisset
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama"
                                                    placeholder="Nama Pengarang" name="nama"
                                                    value="{{ empty($pengarang) ? old('nama') : $pengarang->nama }}"
                                                    required>
                                                <label for="nama">Nama Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="floatingEmail"
                                                    placeholder="Email Pengarang" name="email"
                                                    value="{{ empty($pengarang) ? old('email') : $pengarang->email }}"
                                                    required>
                                                <label for="floatingEmail">Email Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="no_hp"
                                                    placeholder="Nomor Telepon Pengarang" name="no_hp"
                                                    value="{{ empty($pengarang) ? old('no_hp') : $pengarang->no_hp }}"
                                                    required>
                                                <label for="no_hp">Nomor Telepon Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pendidikan_terakhir"
                                                    placeholder="Pendidikan Terakhir Pengarang"
                                                    name="pendidikan_terakhir"
                                                    value="{{ empty($pengarang) ? old('pendidikan_terakhir') : $pengarang->pendidikan_terakhir }}">
                                                <label for="pendidikan_terakhir">Pendidikan Terakhir Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="riwayat_pendidikan"
                                                    placeholder="Riwayat Pendidikan Pengarang" name="riwayat_pendidikan"
                                                    value="{{ empty($pengarang) ? old('riwayat_pendidikan') : $pengarang->riwayat_pendidikan }}">
                                                <label for="riwayat_pendidikan">Riwayat Pendidikan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="penghargaan"
                                                    placeholder="Penghargaan Pengarang" name="penghargaan"
                                                    value="{{ empty($pengarang) ? old('penghargaan') : $pengarang->penghargaan }}">
                                                <label for="penghargaan">Penghargaan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pekerjaan"
                                                    placeholder="Pekerjaan Pengarang" name="pekerjaan"
                                                    value="{{ empty($pengarang) ? old('pekerjaan') : $pengarang->pekerjaan }}">
                                                <label for="pekerjaan">Pekerjaan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pengalaman_kerja"
                                                    placeholder="Pengalaman Kerja Pengarang" name="pengalaman_kerja"
                                                    value="{{ empty($pengarang) ? old('pengalaman_kerja') : $pengarang->pengalaman_kerja }}">
                                                <label for="pengalaman_kerja">Pengalaman Kerja Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="riwayat_pekerjaan"
                                                    placeholder="Riwayat Pekerjaan Pengarang" name="riwayat_pekerjaan"
                                                    value="{{ empty($pengarang) ? old('riwayat_pekerjaan') : $pengarang->riwayat_pekerjaan }}">
                                                <label for="riwayat_pekerjaan">Riwayat Pekerjaan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State"
                                                    name="jenis_kelamin" required>
                                                    <option value="" hidden>Pilih Jenis Kelamin</option>
                                                    <option value="L"
                                                        <?= (empty($pengarang) ? old('jenis_kelamin') : $pengarang->jenis_kelamin) == 'L' ? 'selected' : '' ?>>
                                                        Laki-Laki</option>
                                                    <option value="P"
                                                        <?= (empty($pengarang) ? old('jenis_kelamin') : $pengarang->jenis_kelamin) == 'P' ? 'selected' : '' ?>>
                                                        Perempuan</option>
                                                </select>
                                                <label for="floatingSelect">Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="file" class="form-control" id="foto"
                                                    placeholder="foto" name="foto" accept="image/*">
                                                <label for="foto">foto</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="tempat_lahir"
                                                    placeholder="Tempat Lahir Pengarang" name="tempat_lahir" required
                                                    value="{{ empty($pengarang) ? old('tempat_lahir') : $pengarang->tempat_lahir }}">
                                                <label for="tempat_lahir">Tempat Lahir Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="tanggal_lahir"
                                                    placeholder="Tanggal Lahir Pengarang" name="tanggal_lahir" required
                                                    value="{{ empty($pengarang) ? old('tanggal_lahir') : $pengarang->tanggal_lahir }}">
                                                <label for="tanggal_lahir">Tanggal Lahir Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Deskripsi Pengarang" id="floatingTextarea" style="height: 100px;"
                                                    required name="deskripsi">{{ empty($pengarang) ? old('deskripsi') : $pengarang->deskripsi }}</textarea>
                                                <label for="floatingTextarea">Deskripsi Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Alamat Pengarang" id="floatingTextarea" style="height: 100px;" required
                                                    name="alamat">{{ empty($pengarang) ? old('alamat') : $pengarang->alamat }}</textarea>
                                                <label for="floatingTextarea">Alamat Pengarang</label>
                                            </div>
                                        </div>


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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>
