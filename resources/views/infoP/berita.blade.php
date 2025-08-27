<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BBPTUHPT Baturraden - Berita Terbaru</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="themes/medicio/assets/img/logo.png" rel="icon">
  <link href="themes/medicio/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Google Fonts: Poppins 700 -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="themes/medicio/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="themes/medicio/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="themes/medicio/assets/css/style2.css" rel="stylesheet">

  <style>
    /* Grid berita */
    .grid-berita {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* selalu 3 kolom di desktop */
      gap: 20px;
      margin-bottom: 30px;
    }

    /* Card berita */
    .berita-card {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      min-height: 320px;       /* tinggi minimum supaya seragam */
    }

    .berita-card:hover {
      transform: translateY(-4px);
    }

    /* Thumbnail */
    .berita-thumb img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
    }

    /* Konten */
    .berita-content {
      padding: 12px 14px 16px;
      flex-grow: 1;              /* isi memenuhi ruang */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .berita-content h3 {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
      line-height: 1.4;
    }

    .berita-content h3 a {
      text-decoration: none;
      color: #2F451E;
    }

    .berita-content h3 a:hover {
      color: #00a859;
    }

    .berita-content .tanggal {
      font-size: 12px;
      color: #666;
      margin-top: auto;          /* dorong ke bawah */
    }

    .section-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      color: #2F451E;
      margin-bottom: 25px;
      text-align: center;
      font-size: 28px;
    }

    .berita-terbaru {
      padding: 60px 0;
      background-color: #f8f9fa;
    }

    /* Perbaikan untuk judul yang tertutup navbar */
    .main-content {
      padding-top: 150px; /* Memberikan ruang agar konten tidak tertutup navbar */
    }

    @media (max-width: 992px) {
      .main-content {
        padding-top: 120px; /* Lebih kecil untuk tampilan mobile */
      }
    }
  </style>
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
      <img src="themes/medicio/assets/img/logo.png" alt="Logo" id="logo-img" style="height: 100px;">

      <!-- Garis Vertikal -->
      <div class="vertical-line mx-2" id="logo-line" style="height: 60px; width: 2px; background: #fff; transition: all 0.3s ease;"></div>

      <!-- Header Image -->
      <img src="themes/medicio/assets/img/header.png" alt="Header Text Image" class="ms-2" style="width: 380px; max-height:60px;">
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
              <!-- Menu dengan Sub Menu (Dropdown) -->
              <a href="{{ $menu->link ?: '#' }}" target="{{ $menu->target }}">
                <span>{{ strtoupper($menu->nama) }}</span>
                <i class="bi bi-chevron-down"></i>
              </a>
              <ul class="dropdown-menu">
                @foreach($menu->children as $child)
                  @if($child->hasChildren())
                    <!-- Sub Menu yang juga punya anak -->
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
                    <!-- Sub Menu biasa -->
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
              <!-- Menu tanpa Sub Menu -->
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
          <!-- Garis Vertikal kiri Search -->
          <div class="vertical-line me-2" id="search-line" style="height: 30px; width: 2px; background: #fff; transition: all 0.3s ease;"></div>
          <a href="#" class="search-icon"><i class="bi bi-search"></i></a>
        </li>
      </ul>

      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
  </div>
</header>


  <main id="main" class="main-content">
    <!-- ======= Berita Terbaru Section ======= -->
    <section id="berita-terbaru" class="berita-terbaru py-5">
    <div class="container">
      <h2 class="section-title mb-4">Berita Terbaru</h2>

      <div class="grid-berita">
        @foreach ($beritas as $berita)
        <div class="berita-card">
            <div class="berita-thumb">
                @if ($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                @else
                    <img src="{{ asset('themes/medicio/assets/img/no-image.png') }}" alt="No Image">
                @endif
            </div>
            <div class="berita-content">
                <h3>{{ $berita->judul }}</h3>
                <p class="tanggal"><i class="bi bi-calendar"></i> {{ $berita->created_at->translatedFormat('l, d F Y') }}</p>
                <p class="isi">{{ Str::limit(strip_tags($berita->isi), 120) }}</p>
            </div>
        </div>
        @endforeach
      </div>

      <div class="mt-4">
        {{ $beritas->links() }}
      </div>
    </div>
  </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-contact">
            <h3>Kantor BBPTUHPT</h3>
            <p>
              Jl. Raya Baturraden, Ds Kemutug Lor Kec. Baturraden, Kab. Banyumas Jawa Tengah 53151<br><br>
              <strong>Telepon:</strong> (0281) 681716<br>
              <strong>Fax:</strong> (0281) 681037<br>
              <strong>Email:</strong> bbpubptibaturraden@gmail.com<br>
              <strong>Website:</strong> https://bbptusapiperah.ditjenpkh.pertanian.go.id<br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h3>Kontak Penting</h3>
            <div class="contact-box">
              <i class="bi bi-whatsapp"></i>
              <div>
                <p>Layanan Informasi Publik, Kunjungan, Magang, PKL & Pengaduan</p>
                <strong>085504411118 (Tri Juliyanta, SH, MH)</strong>
              </div>
            </div>
            <div class="contact-box">
              <i class="bi bi-whatsapp"></i>
              <div>
                <p>Layanan Pemasaran dan Informasi Bibit</p>
                <strong>085505111118 (Hery Supriadi, S.Pt., M.Pt)</strong>
              </div>
            </div>
            <div class="contact-box">
              <h4>Posko Nasional Tanggap Daruret</h4>
              <p>Penanganan, Pelaporan, dan Koordinasi PMK Nasional</p>
              <strong>0812-8634-5622, 0812-8634-5633</strong>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>Lain-lain</h3>
            <div class="service-hours">
              <h4><i class="bi bi-clock"></i> Jam Pelayanan</h4>
              <p>Senin s.d Kamis 08.00 s.d 15.00 WIB</p>
              <p>Jum'at 08.00 s.d 15.30 WIB</p>
            </div>

            <div class="certification">
              <h4>Sistem Manajemen Mutu</h4>
              <div class="row">
                <div class="col-6">
                  <img src="themes/medicio/assets/img/iso-9001.png" alt="ISO 9001:2015" class="img-fluid">
                </div>
                <div class="col-6">
                  <img src="themes/medicio/assets/img/iso-37001.png" alt="ISO 37001:2016" class="img-fluid">
                </div>
              </div>
            </div>

            <div class="visitor-stats mt-3">
              <h4>Statistik Pengunjung:</h4>
              <table class="table table-sm table-borderless">
                <tr>
                  <td>21,279</td>
                  <td>55</td>
                </tr>
                <tr>
                  <td>1,649</td>
                  <td>49</td>
                </tr>
                <tr>
                  <td>20</td>
                  <td>33</td>
                </tr>
                <tr>
                  <td>40</td>
                  <td>34</td>
                </tr>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>BBPTUHPT Baturraden</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="themes/medicio/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="themes/medicio/assets/vendor/aos/aos.js"></script>
  <script src="themes/medicio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="themes/medicio/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="themes/medicio/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="themes/medicio/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="themes/medicio/assets/js/main.js"></script>

</body>

</html>
