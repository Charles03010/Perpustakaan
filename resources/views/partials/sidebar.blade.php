@php
    $data = [
        [
            'title' => 'Dashboard',
            'icon' => 'bi-grid',
            'url' => 'dashboard-admin',
            'color' => $active == 'dashboard' ? '' : 'collapsed',
        ],
        [
            'title' => 'Peminjaman',
            'icon' => 'bi-bookmark',
            'url' => 'peminjaman-admin',
            'color' => $active == 'peminjaman' ? '' : 'collapsed',
        ],
        [
            'title' => 'Pengarang',
            'icon' => 'bi-people',
            'url' => 'pengarang-admin',
            'color' => $active == 'pengarang' ? '' : 'collapsed',
        ],
        [
            'title' => 'Penerbit',
            'icon' => 'bi-upload',
            'url' => 'penerbit-admin',
            'color' => $active == 'penerbit' ? '' : 'collapsed',
        ],
        [
            'title' => 'Buku',
            'icon' => 'bi-book',
            'url' => 'buku-admin',
            'color' => $active == 'buku' ? '' : 'collapsed',
        ],
        [
            'title' => 'Skripsi',
            'icon' => 'bi-blockquote-left',
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
                    <i class="bi {{ $item['icon'] }}"></i>
                    <span>{{ $item['title'] }}</span>
                </a>
            </li>
        @endforeach

    </ul>

</aside><!-- End Sidebar-->
