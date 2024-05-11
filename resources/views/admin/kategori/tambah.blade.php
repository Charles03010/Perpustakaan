@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('partials.topnav')

    @include('partials.sidebar', ['active' => 'kategori'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kategori</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
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
                                        {{ empty($kategori) ? 'Tambah Data Kategori' : 'Edit Data Kategori' }}</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" action="{{ route('admin.kategori.store') }}" method="POST">
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
                                        @isset($kategori)
                                            @empty(!$kategori)
                                                <input type="hidden" name="id_kategori" value="{{ $kategori->id_kategori }}">
                                            @endempty
                                        @endisset
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama_kategori"
                                                    placeholder="Nama kategori" name="nama_kategori"
                                                    value="{{ empty($kategori) ? old('nama_kategori') : $kategori->nama_kategori }}"
                                                    required>
                                                <label for="nama_kategori">Nama kategori</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Deskripsi kategori" id="floatingTextarea" style="height: 100px;" required
                                                    name="deskripsi">{{ empty($kategori) ? old('deskripsi') : $kategori->deskripsi }}</textarea>
                                                <label for="floatingTextarea">Deskripsi kategori</label>
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
