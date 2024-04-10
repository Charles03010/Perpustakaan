@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('components.header')

    @include('partials.sidebar', ['active' => 'penerbit'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Penerbit</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
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
                                    <h5 class="card-title">Detail Data Penerbit</h5>
                                    <div class="d-flex align-items-start">
                                        <img class="w-25 me-3" src="{{ asset('storage/' . $penerbit->foto) }}"
                                            alt="Foto Penerbit">
                                        <dl class="row">
                                            <dt class="col-sm-3 mb-3">Nama</dt>
                                            <dd class="col-sm-9">{{ $penerbit->nama_penerbit }}</dd>

                                            <dt class="col-sm-3 mb-3">Email</dt>
                                            <dd class="col-sm-9">{{ $penerbit->email }}</dd>

                                            <dt class="col-sm-3 mb-3">No Telepon</dt>
                                            <dd class="col-sm-9">{{ $penerbit->no_hp }}</dd>

                                            <dt class="col-sm-3 mb-3">Alamat</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $penerbit->alamat }}</p>
                                            </dd>

                                            <dt class="col-sm-3 mb-3">Deskripsi</dt>
                                            <dd class="col-sm-9">
                                                <p>{{ $penerbit->deskripsi }}</p>
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
