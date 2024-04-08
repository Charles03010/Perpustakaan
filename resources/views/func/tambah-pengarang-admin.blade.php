@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('components.header')

    @include('partials.sidebar', ['active' => 'dashboard'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengarang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pengarang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Tambah Data Pengarang</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" action="{{ route('add.process') }}" method="POST">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>                                            
                                        @endif
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama"
                                                    placeholder="Nama Pengarang" name="nama" value="{{old('nama')}}" required>
                                                <label for="nama">Nama Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="floatingEmail"
                                                    placeholder="Email Pengarang" name="email" value="{{old('email')}}" required>
                                                <label for="floatingEmail">Email Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="no"
                                                    placeholder="Nomor Telepon Pengarang" name="no" value="{{old('no')}}" required>
                                                <label for="no">Nomor Telepon Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pendidikanTerakhir"
                                                    placeholder="Pendidikan Terakhir Pengarang"
                                                    name="pendidikanTerakhir" value="{{old('pendidikanTerakhir')}}">
                                                <label for="pendidikanTerakhir">Pendidikan Terakhir Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pendidikanRiwayat"
                                                    placeholder="Riwayat Pendidikan Pengarang" name="pendidikanRiwayat" value="{{old('pendidikanRiwayat')}}">
                                                <label for="pendidikanRiwayat">Riwayat Pendidikan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="penghargaan"
                                                    placeholder="Penghargaan Pengarang" name="penghargaan" value="{{old('penghargaan')}}">
                                                <label for="penghargaan">Penghargaan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pekerjaan"
                                                    placeholder="Pekerjaan Pengarang" name="pekerjaan" value="{{old('pekerjaan')}}">
                                                <label for="pekerjaan">Pekerjaan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pengalamanKerja"
                                                    placeholder="Pengalaman Kerja Pengarang" name="pengalamanKerja" value="{{old('pengalamanKerja')}}">
                                                <label for="pengalamanKerja">Pengalaman Kerja Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="riwayatPekerjaan"
                                                    placeholder="Riwayat Pekerjaan Pengarang" name="riwayatPekerjaan" value="{{old('riwayatPekerjaan')}}">
                                                <label for="riwayatPekerjaan">Riwayat Pekerjaan Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State" name="jenisKelamin"
                                                    required>
                                                    <option value="" hidden>Pilih Jenis Kelamin</option>
                                                    <option value="L" <?= old('jenisKelamin') == 'L'?"selected":"" ?>>Laki-Laki</option>
                                                    <option value="P" <?= old('jenisKelamin') == 'P'?"selected":"" ?>>Perempuan</option>
                                                </select>
                                                <label for="floatingSelect">Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="foto"
                                                    placeholder="foto" name="foto" value="{{old('foto')}}">
                                                <label for="foto">foto</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="tempatLahir"
                                                    placeholder="Tempat Lahir Pengarang" name="tempatLahir" required value="{{old('tempatLahir')}}">
                                                <label for="tempatLahir">Tempat Lahir Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="tanggalLahir"
                                                    placeholder="Tanggal Lahir Pengarang" name="tanggalLahir" required value="{{old('tanggalLahir')}}">
                                                <label for="tanggalLahir">Tanggal Lahir Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Deskripsi Pengarang" id="floatingTextarea" style="height: 100px;"
                                                    required name="desk">{{old('desk')}}</textarea>
                                                <label for="floatingTextarea">Deskripsi Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Alamat Pengarang" id="floatingTextarea" style="height: 100px;" required
                                                    name="alamat">{{old('alamat')}}</textarea>
                                                <label for="floatingTextarea">Alamat Pengarang</label>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
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

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>
