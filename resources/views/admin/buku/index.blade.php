@include('partials.header', ['title' => 'Dashboard Admin'])
@include('partials.scripts')

<body>

    <!-- ======= Header ======= -->
    @include('partials.topnav')

    @include('partials.sidebar', ['active' => 'buku'])

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
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
                                    <a href="{{ route('admin.buku.create') }}" class="btn btn-primary">
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
                                                <th scope="col" class="max-content">Tahun Terbit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($buku as $item)
                                                <tr class="align-middle">
                                                    <td class="max-content" scope="row">{{ $loop->iteration }}</td>
                                                    <td class="max-content">
                                                        <form
                                                            action="{{ route('admin.buku.destroy', $item[0]->id_buku) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-3 p-2 rounded bg-danger me-2 border border-0">
                                                                <i class="bi bi-trash text-white"></i>
                                                            </button>
                                                            <a href="{{ route('admin.buku.edit', $item[0]->id_buku) }}"
                                                                class="w-3 p-2 rounded bg-warning me-2">
                                                                <i class="bi bi-pencil text-white"></i>
                                                            </a>
                                                            <a href="{{ route('admin.buku.show', $item[0]->id_buku) }}"
                                                                class="w-3 p-2 rounded bg-primary">
                                                                <i class="bi bi-eye text-white"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                    <td class="max-content"><img
                                                            src="{{ asset('storage/' . $item[0]->foto) }}"
                                                            style="width:10rem" alt="{{ $item[1]->judul }}"></td>
                                                    <td>{{ $item[1]->judul }}</td>
                                                    <td>{{ $item[1]->tahun_terbit }}</td>
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
    @include('partials.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>
