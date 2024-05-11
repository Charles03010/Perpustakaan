@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('partials.topnav')

    @include('partials.sidebar', ['active' => 'penerbit'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Penerbit</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Penerbit</li>
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
                                        {{ empty($penerbit) ? 'Tambah Data Penerbit' : 'Edit Data Penerbit' }}</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" action="{{ route('admin.penerbit.store') }}" method="POST"
                                        enctype="multipart/form-data">
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
                                        @isset($penerbit)
                                            @empty(!$penerbit)
                                                <input type="hidden" name="id_penerbit" value="{{ $penerbit->id_penerbit }}">
                                            @endempty
                                        @endisset
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama_penerbit"
                                                    placeholder="Nama penerbit" name="nama_penerbit"
                                                    value="{{ empty($penerbit) ? old('nama_penerbit') : $penerbit->nama_penerbit }}"
                                                    required>
                                                <label for="nama_penerbit">Nama penerbit</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="floatingEmail"
                                                    placeholder="Email penerbit" name="email"
                                                    value="{{ empty($penerbit) ? old('email') : $penerbit->email }}"
                                                    required>
                                                <label for="floatingEmail">Email penerbit</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="no_hp"
                                                    placeholder="Nomor Telepon penerbit" name="no_hp"
                                                    value="{{ empty($penerbit) ? old('no_hp') : $penerbit->no_hp }}"
                                                    required>
                                                <label for="no_hp">Nomor Telepon penerbit</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="file" class="form-control" id="foto"
                                                    placeholder="foto" name="foto" accept="image/*">
                                                <label for="foto">foto</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Deskripsi penerbit" id="floatingTextarea" style="height: 100px;" required
                                                    name="deskripsi">{{ empty($penerbit) ? old('deskripsi') : $penerbit->deskripsi }}</textarea>
                                                <label for="floatingTextarea">Deskripsi penerbit</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Alamat penerbit" id="floatingTextarea" style="height: 100px;" required
                                                    name="alamat">{{ empty($penerbit) ? old('alamat') : $penerbit->alamat }}</textarea>
                                                <label for="floatingTextarea">Alamat penerbit</label>
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
