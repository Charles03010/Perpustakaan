@php
    $data = [
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'url' => 'admin.dashboard',
            'color' => $active == 'dashboard' ? '' : 'collapsed',
        ],
        [
            'title' => 'Peminjaman',
            'icon' => 'today',
            'url' => 'admin.peminjaman.index',
            'color' => $active == 'peminjaman' ? '' : 'collapsed',
        ],
        [
            'title' => 'Pengarang',
            'icon' => 'groups',
            'url' => 'admin.pengarang.index',
            'color' => $active == 'pengarang' ? '' : 'collapsed',
        ],
        [
            'title' => 'Penerbit',
            'icon' => 'upload',
            'url' => 'admin.penerbit.index',
            'color' => $active == 'penerbit' ? '' : 'collapsed',
        ],
        [
            'title' => 'Kategori',
            'icon' => 'category',
            'url' => 'admin.kategori.index',
            'color' => $active == 'kategori' ? '' : 'collapsed',
        ],
        [
            'title' => 'Fakultas',
            'icon' => 'school',
            'url' => 'admin.fakultas.index',
            'color' => $active == 'fakultas' ? '' : 'collapsed',
        ],
        [
            'title' => 'Prodi',
            'icon' => 'web',
            'url' => 'admin.prodi.index',
            'color' => $active == 'prodi' ? '' : 'collapsed',
        ],
        [
            'title' => 'Buku',
            'icon' => 'book',
            'url' => 'admin.buku.index',
            'color' => $active == 'buku' ? '' : 'collapsed',
        ],
        [
            'title' => 'Skripsi',
            'icon' => 'Article',
            'url' => 'admin.skripsi.index',
            'color' => $active == 'skripsi' ? '' : 'collapsed',
        ],
    ];
@endphp
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @foreach ($data as $item)
            <li class="nav-item">
                <a class="nav-link {{ $item['color'] }}" href="{{ route($item['url']) }}">
                    {{-- <i class="bi {{ $item['icon'] }}"></i> --}}
                    <i class="material-symbols-rounded" style="font-size: 1.5rem">
                        {{ $item['icon'] }}
                    </i>
                    <span>{{ $item['title'] }}</span>
                </a>
            </li>
        @endforeach

    </ul>

</aside><!-- End Sidebar-->
