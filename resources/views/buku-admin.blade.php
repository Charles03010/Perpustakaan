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
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Buku</h5>
                                    <a href="{{ route('tambah-buku-admin') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-square"></i>
                                        Tambah Data
                                    </a>
                                    <!-- Table with hoverable rows -->
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="2">No.</th>
                                                <th scope="col">Foto</th>
                                                <th scope="col">Judul</th>
                                                <th scope="col">Tahun Terbit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @dd($buku)
                                            @foreach ($buku as $item)
                                                <tr class="align-middle">
                                                    <td class="max-content" scope="row">{{ $loop->iteration }}</td>
                                                    <td class="max-content">
                                                        <a href="{{ route('delete-buku-admin', $item->id_buku) }}"
                                                            class="w-3 p-2 rounded bg-danger me-2">
                                                            <i class="bi bi-trash text-white"></i>
                                                        </a>
                                                        <a href="{{ route('edit-buku-admin', $item->id_buku) }}"
                                                            class="w-3 p-2 rounded bg-warning me-2">
                                                            <i class="bi bi-pencil text-white"></i>
                                                        </a>
                                                        <a href="{{ route('detail-buku-admin', $item->id_buku) }}"
                                                            class="w-3 p-2 rounded bg-primary">
                                                            <i class="bi bi-eye text-white"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->foto }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->tahun_terbit }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <!-- End Table with hoverable rows -->
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
