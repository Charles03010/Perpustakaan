@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('components.header')

    @include('partials.sidebar', ['active' => 'buku'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Buku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- @dd($pengarang, $penerbit, $kategori) --}}
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ empty($buku) ? 'Tambah Data buku' : 'Edit Data buku' }}</h5>
                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" action="{{ route('addBuku.process') }}" method="POST"
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
                                        @isset($buku)
                                            @empty(!$buku)
                                                <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
                                            @endempty
                                        @endisset
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="judul"
                                                    placeholder="Judul Buku" name="judul"
                                                    value="{{ empty($repo) ? old('judul') : $repo->judul }}" required>
                                                <label for="judul">Judul Buku</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="tahun"
                                                    placeholder="Tahun Terbit Buku" name="tahun"
                                                    value="{{ empty($repo) ? old('tahun') : $repo->tahun_terbit }}"
                                                    required>
                                                <label for="tahun">Tahun Terbit buku</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State"
                                                    name="id_pengarang" required>
                                                    <option value="" hidden>Pilih Pengarang</option>
                                                    @foreach ($pengarang as $item)
                                                        <option value="{{ $item->id_pengarang }}"
                                                            <?= (empty($repo) ? old('id_pengarang') : $repo->id_pengarang) == $item->id_pengarang ? 'selected' : '' ?>>
                                                            {{ $item->id_pengarang.' - '.$item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Pilih Pengarang</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State"
                                                    name="id_penerbit" required>
                                                    <option value="" hidden>Pilih Penerbit</option>
                                                    @foreach ($penerbit as $item)
                                                        <option value="{{ $item->id_penerbit }}"
                                                            <?= (empty($repo) ? old('id_penerbit') : $repo->id_penerbit) == $item->id_penerbit ? 'selected' : '' ?>>
                                                            {{ $item->id_penerbit.' - '.$item->nama_penerbit }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Pilih Penerbit</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State"
                                                    name="id_kategori" required>
                                                    <option value="" hidden>Pilih Kategori</option>
                                                    @foreach ($kategori as $item)
                                                        <option value="{{ $item->id_kategori }}"
                                                            <?= (empty($repo) ? old('id_kategori') : $repo->id_kategori) == $item->id_kategori ? 'selected' : '' ?>>
                                                            {{ $item->id_kategori.' - '.$item->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Pilih Kategori</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="file" class="form-control" id="foto"
                                                    placeholder="foto" name="foto" accept="image/*">
                                                <label for="foto">Foto</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Deskripsi buku" id="floatingTextarea" style="height: 100px;" required
                                                    name="desk">{{ empty($repo) ? old('desk') : $repo->deskripsi }}</textarea>
                                                <label for="floatingTextarea">Deskripsi buku</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="isbn"
                                                    placeholder="ISBN buku" name="isbn"
                                                    value="{{ empty($buku) ? old('isbn') : $buku->isbn }}"
                                                    required>
                                                <label for="isbn">ISBN buku</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="jumlah"
                                                    placeholder="Jumlah Buku" name="jumlah"
                                                    value="{{ empty($buku) ? old('jumlah') : $buku->jumlah_buku }}"
                                                    required>
                                                <label for="jumlah">Jumlah buku</label>
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
