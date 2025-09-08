<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BBPTUHPT Baturraden</title>
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
  <link href="themes/medicio/assets/css/style.css" rel="stylesheet">

  <link href="themes/medicio/assets/css/style.css" rel="stylesheet">

    <style>
    .card-orange  { background-color: #ff8243 !important; }
    .card-blue    { background-color: #6495ed !important; }
    .card-teal    { background-color: #4cb3ac !important; }
    .card-maroon  { background-color: #8b0000 !important; }
    </style>


  <!-- =======================================================
  * Template Name: Medicio
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center">
  <div class="container d-flex justify-content-start">
    <div class="topbar-info">
      Jam Layanan: Senin - Kamis: 08.00 - 15.00, Jumat : 08.00 - 15.30
    </div>
  </div>
</div>

<!-- ======= Header ======= -->
<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center">
  <div class="container d-flex justify-content-start">
    <div class="topbar-info">
      Jam Layanan: Senin - Kamis: 08.00 - 15.00, Jumat : 08.00 - 15.30
    </div>
  </div>
</div>

<!-- ======= Header ======= -->
<!-- Topbar -->
<div id="topbar">
  <div class="container-fluid">
    <div class="topbar-info text-start">
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
        <a href="#" class="search-icon" onclick="openSearchModal()" style="text-decoration: none;">
            <i class="bi bi-search"></i>
        </a>
        </li>
      </ul>

      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
  </div>
</header>

  <!-- ======= Search Box ======= -->
    <div class="search-modal" id="searchModal">
    <div class="search-container">
        <button class="close-search" onclick="closeSearchModal()">&times;</button>
        
        <div class="search-header">
            <h3>Pencarian</h3>
            <p style="color: #666; font-size: 14px; text-align: center; margin: 0;">Cari informasi, artikel, layanan, atau konten lainnya</p>
        </div>

        <div class="search-input-group">
            <input type="text" 
                   class="search-input" 
                   id="searchInput" 
                   placeholder="Ketik kata kunci pencarian..."
                   autocomplete="off">
            <button class="search-btn" onclick="performSearch()">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <!-- Search Suggestions -->
        <div class="search-suggestions" id="searchSuggestions">
            <h5 style="color: #2F451E; font-size: 14px; font-weight: 600; margin-bottom: 15px; text-transform: uppercase;">Pencarian Populer</h5>
            <div class="suggestion-item" onclick="searchFor('profil instansi')">
                <i class="bi bi-building"></i>
                <span>Profil Instansi</span>
            </div>
            <div class="suggestion-item" onclick="searchFor('layanan publik')">
                <i class="bi bi-gear"></i>
                <span>Layanan Publik</span>
            </div>
            <div class="suggestion-item" onclick="searchFor('berita terbaru')">
                <i class="bi bi-newspaper"></i>
                <span>Berita Terbaru</span>
            </div>
            <div class="suggestion-item" onclick="searchFor('kontak')">
                <i class="bi bi-telephone"></i>
                <span>Informasi Kontak</span>
            </div>
        </div>

        <!-- Search Results -->
        <div class="search-results" id="searchResults">
            <!-- Results will be populated here -->
        </div>

        <!-- No Results -->
        <div style="display: none; text-align: center; padding: 40px; color: #666;" id="noResults">
            <i class="bi bi-search" style="font-size: 48px; color: #ddd; margin-bottom: 15px;"></i>
            <h5>Tidak ada hasil ditemukan</h5>
            <p>Coba gunakan kata kunci yang berbeda</p>
        </div>
    </div>
</div>

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators" id="hero-carousel-indicators">
                @foreach($sliders as $index => $slider)
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <!-- Slides -->
            <div class="carousel-inner" role="listbox">
                @forelse($sliders as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" 
                        style="background-image: url('{{ asset('storage/' . $slider->gambar) }}')">
                        <div class="carousel-container text-center">
                            @if($slider->judul)
                                <h2 class="animate__animated animate__fadeInDown">{{ $slider->judul }}</h2>
                            @endif
                            @if($slider->deskripsi)
                                <p class="animate__animated animate__fadeInUp">{{ $slider->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Fallback jika belum ada slider -->
                    <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg')">
                        <div class="carousel-container text-center">
                            <h2>Selamat Datang</h2>
                            <p>Tambahkan slider melalui dashboard admin.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section><!-- End Hero -->




  <main id="main">

   <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services py-5">
    <div class="container" data-aos="fade-up">

        <!-- Judul -->
        <div class="text-center mb-5">
        <h3 class="fw-bold" style="color: #024422;">SELAMAT DATANG DI<br>BBPTUHPT Baturaden</h3>
        <h4 class="fw-bold mt-3" style="color: #024422;">INFORMASI UNTUK ANDA</h4>
        <p>Klik info lebih detil :</p>
        <hr style="width: 60px; height: 2px; background: #000; margin: 10px auto;">
        </div>

        <!-- Kartu Informasi -->
        <div class="row justify-content-center gx-2 gy-3">
        <!-- Kartu 1 -->
        <div class="col-auto">
            <div class="icon-box card-orange">
            <div class="top-line"></div>
            <div class="card-content">
                <img src="themes/medicio/assets/img/produk.jpg" alt="Produk">
            </div>
            <h5>PRODUK DAN LAYANAN</h5>
            </div>
        </div>

        <!-- Kartu 2 -->
        <div class="col-auto">
            <div class="icon-box card-blue">
            <div class="top-line"></div>
            <div class="card-content">
                <img src="themes/medicio/assets/img/info.jpg" alt="Informasi">
            </div>
            <h5>PERMOHONAN INFORMASI</h5>
            </div>
        </div>

        <!-- Kartu 3 -->
        <div class="col-auto">
            <div class="icon-box card-teal">
            <div class="top-line"></div>
            <div class="card-content">
                <img src="themes/medicio/assets/img/harga.jpg" alt="Harga">
            </div>
            <h5>HARGA KOMODITAS TERNAK</h5>
            </div>
        </div>

        <!-- Kartu 4 -->
        <div class="col-auto">
            <div class="icon-box card-maroon">
            <div class="top-line"></div>
            <div class="card-content">
                <img src="themes/medicio/assets/img/kegiatan.jpg" alt="Kegiatan">
            </div>
            <h5>KEGIATAN BBPTUHPT</h5>
            </div>
        </div>
        </div>
    </div>
    </section>
    <!-- End Featured Service Section -->



    <!-- ======= Layanan Kami Section ======= -->
    <section id="layanan-kami" class="layanan-kami py-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
        <h2>LAYANAN KAMI</h2>
        <p>BBPTUHPT Baturraden mempunyai layanan terbaik untuk memenuhi kebutuhan anda</p>
        <hr style="width: 60px; border: 2px solid #2d4e21; margin: 0 auto;">
        </div>

        <div class="row text-center mt-4">
        <div class="col-md-3 mb-4">
            <div class="card layanan-box h-100">
            <div class="img-hover-zoom">
                <img src="themes/medicio/assets/img/sapi.jpg" class="img-fluid rounded" alt="...">
            </div>
            <h5 class="mt-3 fw-bold">PEMBELIAN BIBIT TERNAK ONLINE</h5>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card layanan-box h-100">
            <div class="img-hover-zoom">
                <img src="themes/medicio/assets/img/balai.jpg" class="img-fluid rounded" alt="...">
            </div>
            <h5 class="mt-3 fw-bold">LAYANAN SEWA ASET BALAI</h5>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card layanan-box h-100">
            <div class="img-hover-zoom">
                <img src="themes/medicio/assets/img/bimtek.jpg" class="img-fluid rounded" alt="...">
            </div>
            <h5 class="mt-3 fw-bold">LAYANAN BIMBINGAN TEKNIS (BIMTEK)</h5>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card layanan-box h-100">
            <div class="img-hover-zoom">
                <img src="themes/medicio/assets/img/kegiatan.jpg" class="img-fluid rounded" alt="...">
            </div>
            <h5 class="mt-3 fw-bold">LAYANAN KONSULTASI DOKTER HEWAN</h5>
            </div>
        </div>
        </div>
    </div>
    </section>

    <!-- ======= Informasi Terbaru Section ======= -->
    <section id="informasi-terbaru" class="py-5 bg-light">
        <div class="container" data-aos="fade-up">
            <!-- Judul -->
            <div class="row mb-4">
                <div class="col-lg-3">
                    <h3 class="fw-bold text-dark">Informasi Terbaru</h3>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar Kategori -->
                <div class="col-lg-3 mb-4">
                    <div class="list-group shadow rounded overflow-hidden">
                        <a href="{{ route('infoP.berita') }}" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="fas fa-newspaper me-2"></i> Berita
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <i class="far fa-calendar-alt me-2"></i> Agenda
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-success text-white">
                            <i class="fas fa-bullhorn me-2"></i> Pengumuman
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <i class="fas fa-book-open me-2"></i> Artikel
                        </a>
                    </div>
                </div>

                <!-- Konten Informasi -->
                    <!-- Berita Terbaru -->
                        <div class="col-lg-9 mt-5">
                            <div class="row g-4">
                                @forelse ($beritaTerbaru as $berita)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                    @if ($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('themes/medicio/assets/img/no-image.png') }}" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title flex-grow-1">{{ Str::limit($berita->judul, 60) }}</h6>
                                        <small class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $berita->created_at->translatedFormat('l, d F Y') }}
                                        </small>
                                    </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center">
                                    <p class="text-muted">Belum ada berita tersedia</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                    <!-- Tombol Lihat Semua Berita -->
                    <div class="text-center mt-4">
                        <a href="{{ route('infoP.berita') }}" class="btn btn-primary">
                            <i class="fas fa-eye me-2"></i>Lihat Semua Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Informasi Section -->

   <!-- ======= Profil BBPTUHPT Section ======= -->
    <section id="features" class="features py-5">
    <div class="container text-center" data-aos="fade-up">

        <!-- Judul -->
        <h3 class="profil-title mb-4">PROFIL BBPTUHPT</h3>

        <!-- Video -->
        <div class="video-wrapper mb-3">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/DIGANTIKAN_ID_VIDEO"
                    title="Profil BBPTUHPT BATURRADEN 2022"
                    allowfullscreen>
            </iframe>
        </div>
        </div>

        <!-- Subjudul -->
        <p class="profil-subtitle mb-2">
        Mengenal Lebih Dekat Balai Besar Pembibitan Ternak Unggul dan Hijauan Pakan Ternak Baturraden
        </p>

        <!-- Deskripsi -->
        <div class="profil-desc mt-2">
        <p>
            Balai Besar Pembibitan Ternak Unggul dan Hijauan Pakan Ternak (BBPTUHPT) Baturraden sebagai salah satu dari Unit Pelaksana Teknis lingkup direktorat jenderal peternakan dan kesehatan hewan Kementerian Pertanian terus bekerja keras untuk memenuhi ketersediaan bibit unggul sapi perah dan kambing perah di Indonesia. Sebagai institusi yang profesional dalam menghasilkan bibit sapi perah, kambing perah dan hijauan pakan ternak kami didukung oleh SDM profesional dan disiplin tinggi yang berkomitmen memberikan pelayanan yang terbaik untuk masyarakat dalam mengembangkan bibit-bibit unggul yang berkualitas, berdaya saing dan berkelanjutan sesuai standar mutu.
        </p>
        </div>

    </div>
    </section>

    <!-- End Features Section -->

    <!-- ======= Media Sosial Section ======= -->
    <section id="media-sosial" class="media-sosial section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
        <h2 class="fw-bold text-dark">MEDIA SOSIAL</h2>
        <p>Klik info lebih detil :</p>
        <hr style="width: 40px; margin: 10px auto; border-top: 2px solid #000;">
        </div>

        <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="social-card instagram">
            <img src="themes/medicio/assets/img/Instagram.jpg" alt="Instagram">
            <h5>INSTAGRAM</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="social-card facebook">
            <img src="themes/medicio/assets/img/Facebook.jpg" alt="Facebook">
            <h5>FACEBOOK</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="social-card youtube">
            <img src="themes/medicio/assets/img/youtube.png" alt="YouTube">
            <h5>YOUTUBE</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="social-card tiktok">
            <img src="themes/medicio/assets/img/tiktok.png" alt="TikTok">
            <h5>TIKTOK</h5>
            </div>
        </div>
        </div>

    </div>
    </section><!-- End Media Sosial -->


    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Gallery</h2>
            </div>

            <div class="gallery-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach($galeris as $galeri)
                    <div class="swiper-slide">
                        <!-- HANYA GUNAKAN ONCLICK CUSTOM MODAL -->
                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                            class="img-fluid"
                            alt="{{ $galeri->judul }}"
                            onclick="showImagePopup('{{ asset('storage/' . $galeri->gambar) }}', '{{ $galeri->judul }}')"
                            style="cursor: pointer;">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Gallery Section -->

   <!-- Modal Popup untuk Gambar -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content-wrapper" onclick="event.stopPropagation()">
            <span class="close-btn" onclick="closeImageModal()">&times;</span>

            <!-- TOMBOL NAVIGASI PREVIOUS -->
            <button id="prevBtn" class="nav-btn prev-btn" onclick="showPreviousImage()">❮</button>

            <!-- JUDUL DI ATAS GAMBAR -->
            <div class="image-title">
                <h3 id="imageTitle">Judul Gambar</h3>
            </div>

            <!-- GAMBAR -->
            <div class="image-container">
                <img id="modalImg" src="" alt="">
            </div>

            <!-- COUNTER GAMBAR -->
            <div id="imageCounter" class="image-counter">1 / 1</div>

            <!-- TOMBOL NAVIGASI NEXT -->
            <button id="nextBtn" class="nav-btn next-btn" onclick="showNextImage()">❯</button>
        </div>
    </div>


    <!-- ======= Link Terkait Section ======= -->
        <section id="link-terkait" class="link-terkait">
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
            <h2>LINK TERKAIT</h2>
            </div>

            <div class="swiper link-swiper">
            <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link1.jpg" class="img-fluid" alt="Link 1">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link2.jpg" class="img-fluid" alt="Link 2">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link3.jpg" class="img-fluid" alt="Link 3">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link4.jpg" class="img-fluid" alt="Link 4">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link5.jpg" class="img-fluid" alt="Link 5">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link6.jpg" class="img-fluid" alt="Link 6">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link7.jpg" class="img-fluid" alt="Link 7">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link8.jpg" class="img-fluid" alt="Link 8">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link9.jpg" class="img-fluid" alt="Link 9">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link10.jpg" class="img-fluid" alt="Link 10">
                </div>
                <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link11.jpg" class="img-fluid" alt="Link 11">
                </div>
                  <div class="swiper-slide">
                <img src="themes/medicio/assets/img/link_terkait/link12.jpg" class="img-fluid" alt="Link 12">
                </div>
            </div>
            <div class="swiper-pagination"></div>
            </div>
        </div>
        </section><!-- End link Section -->



    <!-- ======= Direktori Section ======= -->
    <section id="direktori" class="direktori">
    <div class="container text-center" data-aos="fade-up">
        <div class="section-title">
        <h2>DIREKTORI</h2>
        <p>Klik info lebih detil :</p>
        </div>

        <div class="row justify-content-center">
        <!-- Kartu Internal -->
        <div class="col-auto mb-4">
            <a href="#" class="direktori-card internal">
            <div class="direktori-slot"></div>
            <div class="direktori-icon"></div>
            <h3>INTERNAL</h3>
            </a>
        </div>

        <!-- Kartu Eksternal -->
        <div class="col-auto mb-4">
            <a href="#" class="direktori-card eksternal">
            <div class="direktori-slot"></div>
            <div class="direktori-icon"></div>
            <h3>EKSTERNAL</h3>
            </a>
        </div>
        </div>

        <!-- Garis dan Bintang -->
        <div class="separator">
        <hr>
        <span class="star">★</span>
        </div>
    </div>
    </section>
    <!-- End Direktori Section -->

  </main><!-- End #main -->
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
                <span>Jum’at &nbsp; 08.00 s.d 15.30 WIB</span>
            </div>

            <div class="sertifikasi">
                <img src="themes/medicio/assets/img/SNI-9001.jpg" alt="SNI ISO 9001">
                <img src="themes/medicio/assets/img/SNI-37001.jpg" alt="SNI ISO 37001">
            </div>

            <div class="statistik">
                <p>Statistik Pengunjung:</p>
                <img src="themes/medicio/assets/img/statistik.png" alt="Statistik">
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
    <!-- End Footer -->
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
