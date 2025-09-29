<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $artikel->judul }} - BBPTUHPT Baturraden</title>
  <meta content="{{ \Illuminate\Support\Str::limit(strip_tags($artikel->isi), 160) }}" name="description">
  <meta content="{{ $artikel->judul }}" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('themes/medicio/assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('themes/medicio/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('themes/medicio/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('themes/medicio/assets/css/style2.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/medicio/assets/css/artikel.css') }}" rel="stylesheet">
</head>

<body>
  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-start">
      <div class="topbar-info">
        Jam Layanan: Senin - Kamis: 08.00 - 15.00, Jumat : 08.00 - 15.30
      </div>
    </div>
  </div>

  <!-- Header / Navbar -->
  <header id="header" class="d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <!-- Logo dan Instansi -->
      <div class="logo d-flex align-items-center" style="padding-left: 20px;">
        <img src="{{ asset('themes/medicio/assets/img/logo.png') }}" alt="Logo" id="logo-img" style="height: 100px;">
        <div class="vertical-line mx-2" id="logo-line" style="height: 60px; width: 2px; background: #fff; transition: all 0.3s ease;"></div>
        <img src="{{ asset('themes/medicio/assets/img/header.png') }}" alt="Header Text Image" class="ms-2" style="width: 380px; max-height:60px;">
      </div>

      <!-- Navbar Dinamis -->
      <nav id="navbar" class="navbar">
        <ul>
          @php
            $menus = App\Models\Menu::mainMenus()->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('urutan');
            }])->get();
          @endphp

          @foreach($menus as $menu)
            <li class="{{ $menu->hasChildren() ? 'dropdown' : '' }}">
              @if($menu->hasChildren())
                <a href="{{ $menu->link ?: '#' }}" target="{{ $menu->target }}">
                  <span>{{ strtoupper($menu->nama) }}</span>
                  <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="dropdown-menu">
                  @foreach($menu->children as $child)
                    @if($child->hasChildren())
                      <li class="dropdown">
                        <a href="{{ $child->link ?: '#' }}" target="{{ $child->target }}">
                          <span>{{ strtoupper($child->nama) }}</span>
                          <i class="bi bi-chevron-right"></i>
                        </a>
                        <ul class="dropdown-menu">
                          @foreach($child->children as $grandChild)
                            <li>
                              <a href="{{ $grandChild->link ?: '#' }}" target="{{ $grandChild->target }}">
                                @if($grandChild->icon)
                                  <i class="{{ $grandChild->icon }}"></i>
                                @endif
                                {{ strtoupper($grandChild->nama) }}
                              </a>
                            </li>
                          @endforeach
                        </ul>
                      </li>
                    @else
                      <li>
                        <a href="{{ $child->link ?: '#' }}" target="{{ $child->target }}">
                          @if($child->icon)
                            <i class="{{ $child->icon }}"></i>
                          @endif
                          {{ strtoupper($child->nama) }}
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              @else
                <a class="nav-link scrollto {{ request()->is(ltrim($menu->link, '/')) ? 'active' : '' }}"
                   href="{{ $menu->link ?: '#' }}" target="{{ $menu->target }}">
                  @if($menu->icon)
                    <i class="{{ $menu->icon }}"></i>
                  @endif
                  {{ strtoupper($menu->nama) }}
                </a>
              @endif
            </li>
          @endforeach

          <!-- Search Icon -->
          <li class="d-flex align-items-center">
            <div class="vertical-line me-2" id="search-line" style="height: 30px; width: 2px; background: #fff; transition: all 0.3s ease;"></div>
            <a href="#" class="search-icon"><i class="bi bi-search"></i></a>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <main id="main" class="main-content">
    <!-- ======= Breadcrumb ======= -->
    <section class="breadcrumb-section">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('infoP.artikel') }}">Artikel</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($artikel->judul, 50) }}</li>
          </ol>
        </nav>
      </div>
    </section>

    <!-- ======= Detail Artikel Section ======= -->
    <section id="artikel-detail" class="artikel-detail-section py-5">
      <div class="container">
        <div class="row">
          <!-- Main Content -->
          <div class="col-lg-8 col-md-12">
            <article class="artikel-detail">
              <!-- Artikel Header -->
              <div class="artikel-header mb-4">
                <h1 class="artikel-title">{{ $artikel->judul }}</h1>
                <div class="artikel-meta">
                  <div class="meta-info d-flex flex-wrap align-items-center gap-3">
                    <span class="meta-item">
                      <i class="bi bi-calendar-event"></i>
                      <span class="meta-label">Tanggal:</span>
                      <span class="meta-value">
                        @if($artikel->tanggal)
                          {{ \Carbon\Carbon::parse($artikel->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        @else
                          {{ \Carbon\Carbon::parse($artikel->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        @endif
                      </span>
                    </span>
                  </div>
                </div>
              </div>

              <!-- Featured Image -->
              @if($artikel->gambar)
              <div class="artikel-featured-image mb-4">
                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid rounded">
                <p class="image-caption mt-2">{{ $artikel->judul }}</p>
              </div>
              @endif

              <!-- Artikel Content -->
              <div class="artikel-content">
                {!! $artikel->isi !!}
              </div>

              <!-- Share Buttons -->
              <div class="artikel-share mt-5">
                <h5>Bagikan Artikel</h5>
                <div class="share-buttons">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                     target="_blank" class="share-btn facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                  </a>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($artikel->judul) }}"
                     target="_blank" class="share-btn twitter">
                    <i class="fab fa-twitter"></i> Twitter
                  </a>
                  <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($artikel->judul) }}"
                     target="_blank" class="share-btn linkedin">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                  </a>
                  <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' ' . url()->current()) }}"
                     target="_blank" class="share-btn whatsapp">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                  </a>
                </div>
              </div>
            </article>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4 col-md-12">
            <aside class="artikel-sidebar">
              <!-- Search Widget -->
              <div class="sidebar-widget search-widget">
                <h5 class="widget-title">Cari Artikel</h5>
                <form class="search-form" action="{{ route('infoP.artikel') }}" method="GET">
                  <div class="search-input-group">
                    <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </form>
              </div>

              <!-- Recent Articles -->
              @if($artikelLainnya && count($artikelLainnya) > 0)
              <div class="sidebar-widget recent-articles">
                <h5 class="widget-title">Artikel Lainnya</h5>
                @foreach($artikelLainnya as $item)
                <div class="recent-article-item">
                  @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="recent-thumb">
                  @else
                    <img src="{{ asset('themes/medicio/assets/img/no-image.png') }}" alt="No Image" class="recent-thumb">
                  @endif
                  <div class="recent-content">
                    <h6><a href="{{ route('infoP.artikel-detail', $item->id) }}">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</a></h6>
                    <span class="recent-date">
                      @if($item->tanggal)
                        {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                      @else
                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                      @endif
                    </span>
                  </div>
                </div>
                @endforeach
              </div>
              @endif
            </aside>
          </div>
        </div>
      </div>
    </section>

    <!-- Related Articles -->
    @if($artikelLainnya && count($artikelLainnya) >= 3)
    <section class="related-articles py-5 bg-light">
      <div class="container">
        <h3 class="section-title text-center mb-5">Artikel Terkait</h3>
        <div class="grid-berita">
          @foreach($artikelLainnya->take(3) as $item)
          <div class="berita-card">
            <div class="berita-thumb">
              @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
              @else
                <img src="{{ asset('themes/medicio/assets/img/no-image.png') }}" alt="No Image">
              @endif
            </div>
            <div class="berita-content">
              <h3><a href="{{ route('infoP.artikel-detail', $item->id) }}">{{ $item->judul }}</a></h3>
              <p class="tanggal">
                <i class="bi bi-calendar"></i>
                @if($item->tanggal)
                  {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                @else
                  {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                @endif
              </p>
              <p class="isi">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}</p>
              <a href="{{ route('infoP.artikel-detail', $item->id) }}" class="btn-baca">Baca Selengkapnya</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <!-- Kolom 1: Kantor BBPTUHPT -->
          <div class="col-lg-4 col-md-6 footer-info">
            <h3>Kantor BBPTUHPT</h3>
            <p>
              <a href="https://maps.google.com" target="_blank" class="alamat-link">
                Jl. Raya Baturraden, Ds Kemutug Lor Kec. Baturraden, Kab. Banyumas Jawa Tengah 53151
              </a><br><br>
              <strong>Telepon:</strong> (0281) 681716<br>
              <strong>Surel:</strong> bbptuhpt_btraden@pertanian.go.id<br>
              bbptuhptbaturraden@gmail.com<br><br>
              <strong>Website:</strong><br>
              <a href="https://bbptusapiperah.ditjenpkh.pertanian.go.id" target="_blank" class="alamat-link">
                https://bbptusapiperah.ditjenpkh.pertanian.go.id
              </a>
            </p>
            <div class="social-links mt-3">
              <a href="#"><i class="bi bi-whatsapp"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
          </div>

          <!-- Kolom 2: Kontak Penting -->
          <div class="col-lg-4 col-md-6 kontak-penting">
            <h3>Kontak Penting</h3>
            <div class="wa-box">
              <i class="bi bi-whatsapp"></i>
              <span>Layanan Informasi Publik, Kunjungan, Magang, PKL & Pengaduan<br>
                <strong>089504411118</strong> (Tri Juliyanta, SH, MH)
              </span>
            </div>
            <div class="wa-box">
              <i class="bi bi-whatsapp"></i>
              <span>Layanan Pemasaran dan Informasi Bibit<br>
                <strong>089505111118</strong> (Hery Supriadi, S.Pt., M.Pt)
              </span>
            </div>
            <p class="posko-title">Posko Nasional Tanggap Darurat</p>
            <p class="posko-desc">Penanganan, Pelaporan, dan Koordinasi PMK Nasional<br>
              0812-8634-5622, 0812-8634-5633
            </p>
          </div>

          <!-- Kolom 3: Lain-lain -->
          <div class="col-lg-4 col-md-12 lain-lain">
            <h3>Lain-lain</h3>
            <div class="jam-pelayanan">
              <p><i class="bi bi-clock"></i> Jam Pelayanan</p>
              <span>Senin s.d Kamis &nbsp; 08.00 s.d 15.00 WIB</span><br>
              <span>Jum'at &nbsp; 08.00 s.d 15.30 WIB</span>
            </div>
            <div class="sertifikasi">
              <img src="{{ asset('themes/medicio/assets/img/SNI-9001.jpg') }}" alt="SNI ISO 9001">
              <img src="{{ asset('themes/medicio/assets/img/SNI-37001.jpg') }}" alt="SNI ISO 37001">
            </div>
            <div class="statistik">
              <p>Statistik Pengunjung:</p>
              <img src="{{ asset('themes/medicio/assets/img/statistik.png') }}" alt="Statistik">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="copyright">
          &copy; <strong><span>BBPTUHPT Baturraden</span></strong>. All Rights Reserved
        </div>
      </div>
    </div>
  </footer>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('themes/medicio/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('themes/medicio/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('themes/medicio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('themes/medicio/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('themes/medicio/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('themes/medicio/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('themes/medicio/assets/js/main.js') }}"></script>
</body>
</html>
