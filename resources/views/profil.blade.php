<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BBPTUHPT Baturraden - Profil</title>
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

  <!-- Custom CSS File -->
  <link href="css/custom.css" rel="stylesheet">

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
<div id="topbar" class="d-flex align-items-center fixed-top">
  <div class="container d-flex justify-content-center justify-content-md-start">
    <div class="topbar-info">
      Jam Layanan: Senin - Kamis: 08.00 - 15.00, Jumat : 08.00 - 15.30
    </div>
  </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center fixed-top">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    <!-- Logo dan Instansi -->
    <div class="logo d-flex align-items-center">
      <img src="themes/medicio/assets/img/logo.png" alt="Logo" class="logo-img">
      <div class="vertical-line mx-2" id="logo-line"></div>
      <img src="themes/medicio/assets/img/header.png" alt="Header Text Image" class="header-text-img">
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
          <div class="vertical-line me-2" id="search-line"></div>
          <a href="#" class="search-icon"><i class="bi bi-search"></i></a>
        </li>
      </ul>

      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
  </div>
</header>

   <main id="main" class="main-content">
    <!-- ======= Profile Section ======= -->
    <section class="profile-section">
        <div class="container">

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Profile Title and Date -->
            <div class="profile-header-content">
            <h1 class="profile-title">Profil BBPTUHPT</h1>
            <div class="profile-date">
                <i class="far fa-calendar-alt"></i>
                <span>Senin, 15 May 2023</span>
            </div>
            </div>

            <!-- Profile Info Section with Logo and Text -->
            <div class="profile-main">
            <div class="row">
                <div class="col-lg-3 col-md-4 text-center">
                <div class="profile-logo-container">
                    <img src="themes/medicio/assets/img/profil.png" alt="Logo BBPTUHPT" class="profile-logo-img">
                </div>
                </div>
                <div class="col-lg-9 col-md-8">
                <div class="profile-intro-section">
                    <h2 class="profile-intro-title">PROFIL BBPTUHPT BATURRADEN</h2>
                    <p class="profile-intro-text">Selamat datang di Balai Besar Pembibitan Ternak Unggul dan Hijauan Pakan Ternak (BBPTUHPT) Baturraden sebagai salah satu dari Unit Pelaksana Teknis (UPT) lingkup Direktorat Jendral Peternakan dan Kesehatan Hewan di bawah Kementrian Pertanian RI.</p>
                </div>
                </div>
            </div>
            </div>

            <!-- Video Section -->
            <div class="video-section">
            <div class="video-container">
                <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/hx3WtWYIDkQ" allowfullscreen></iframe>
                </div>
            </div>
            <p class="video-caption">FASILITAS LABORATORIUM</p>
            </div>

            <!-- Content Paragraphs -->
            <div class="profile-description">
            <p>Sebagai UPT, BBPTUHPT Baturraden mempunyai sejarah yang panjang dan telah mengalami banyak perubahan nama, tugas pokok dan fungsinya. Sejak diresmikan sebagai Induk Taman Ternak Baturraden oleh Wakil Presiden RI Pertama (Drs. M. Hatta) tanggal 23 Juli 1953, kemudian diadakan Unit Usaha Ternak (sapi perah dan babi) PERHEWANI. Pada tanggal 25 Mei 1978 sesuai dengan Surat Keputusan Menteri Pertanian RI Nomor 313/Kpts/Org/5/78 berubah tugas dan fungsinya menjadi Balai Pembibitan Ternak dan Hijauan Makanan Ternak (BPTHMT) Baturraden. Pada tanggal 24 Juli 2002, sesuai Surat Keputusan Menteri Pertanian RI Nomor 290 Tahun 2002, BPTHMT berubah menjadi Balai Pembibitan Ternak Unggul Sapi Perah (BPTU Sapi Perah) dan sampai diresmikannya menjadi Balai Besar Pembibitan Ternak Unggul Sapi Perah (BBPTU Sapi Perah) tanggal 30 Desember 2003, sesuai Surat Keputusan Menteri Pertanian RI Nomor 630/Kpts/OT.140/12/2003.</p>

            <p>Kemudian berdasarkan Peraturan Menteri Pertanian Nomor 55/Permentan/OT.140/5/2013 tanggal 24 Mei 2013, BBPTU Sapi Perah Baturraden berubah menjadi Balai Besar Pembibitan Ternak Unggul dan Hijauan Pakan Ternak (BBPTUHPT) Baturraden yang mempunyai tugas tambahan selain pengembangan bibit sapi perah juga kambing perah unggul serta produksi dan distribusi benih/bibit hijauan pakan ternak.</p>

            <p>Dan untuk saat ini Organisasi dan Tata Kerja BBPTUHPT Baturraden mengacu pada Peraturan Menteri Pertanian Nomor 12 Tahun 2023 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Lingkup Direktorat Jenderal Peternakan dan Kesehatan Hewan, Indonesia, Kementerian Pertanian.</p>
            </div>
        </div>
        </div>
    </section><!-- End Profile Section -->

    <!-- Contact Info Section -->
    <section class="contact-info">
    <div class="container contact-container">

        <!-- Kolom kiri: alamat, kontak, jam -->
        <div class="contact-text">
        <!-- Alamat Kantor Pusat -->
        <h4>Alamat Kantor Pusat</h4>
        <p>
            Jalan Peternakan No 1. Desa Kemutug Lor, Kec. Baturraden, Banyumas <br>
            Kode Pos 53151 atau Kotak Pos 113 Purwokerto Kode Pos 53101, Jawa Tengah
        </p>

        <!-- Hubungi Kami -->
        <h4>Hubungi Kami</h4>
        <p>
            Telp. (0281) 681716 <br>
            Fax. (0281) 681037
        </p>
        <p>
            Email: <a href="mailto:bbptuhptbaturraden@gmail.com">bbptuhptbaturraden@gmail.com</a>
        </p>
        <p>
            Website: <a href="https://bbptusapiperah.ditjenpkh.pertanian.go.id/index.php" target="_blank" rel="noopener">
            https://bbptusapiperah.ditjenpkh.pertanian.go.id/index.php
            </a>
        </p>

        <!-- Jam Pelayanan -->
        <h4>Jam Pelayanan</h4>
        <p>
            <strong>Senin s.d Kamis</strong><br>
            Buka pukul : 08.00 - 15.00 WIB<br>
            Istirahat : 12.00 - 13.00 WIB
        </p>
        <p>
            <strong>Jumat</strong><br>
            Buka pukul : 08.00 - 15.30 WIB<br>
            Istirahat : 11.30 - 13.00 WIB
        </p>
        </div>

        <!-- Kolom kanan: Standarisasi -->
        <div class="contact-image">
        <h4>Standarisasi Pelayanan</h4>
        <img src="themes/medicio/assets/img/standarisasi_pelayanan.png" alt="Standarisasi Pelayanan">
        </div>

    </div>
    </section>

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
                <span>Jum'at &nbsp; 08.00 s.d 15.30 WIB</span>
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
