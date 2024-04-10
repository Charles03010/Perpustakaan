@php
    $data = [
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'url' => 'dashboard-admin',
            'color' => $active == 'dashboard' ? '' : 'collapsed',
        ],
        [
            'title' => 'Peminjaman',
            'icon' => 'today',
            'url' => 'peminjaman-admin',
            'color' => $active == 'peminjaman' ? '' : 'collapsed',
        ],
        [
            'title' => 'Pengarang',
            'icon' => 'groups',
            'url' => 'pengarang-admin',
            'color' => $active == 'pengarang' ? '' : 'collapsed',
        ],
        [
            'title' => 'Penerbit',
            'icon' => 'upload',
            'url' => 'penerbit-admin',
            'color' => $active == 'penerbit' ? '' : 'collapsed',
        ],
        [
            'title' => 'Kategori',
            'icon' => 'category',
            'url' => 'kategori-admin',
            'color' => $active == 'kategori' ? '' : 'collapsed',
        ],
        [
            'title' => 'Fakultas',
            'icon' => 'school',
            'url' => 'fakultas-admin',
            'color' => $active == 'fakultas' ? '' : 'collapsed',
        ],
        [
            'title' => 'Prodi',
            'icon' => 'web',
            'url' => 'prodi-admin',
            'color' => $active == 'prodi' ? '' : 'collapsed',
        ],
        [
            'title' => 'Buku',
            'icon' => 'book',
            'url' => 'buku-admin',
            'color' => $active == 'buku' ? '' : 'collapsed',
        ],
        [
            'title' => 'Skripsi',
            'icon' => 'Article',
            'url' => 'skripsi-admin',
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
