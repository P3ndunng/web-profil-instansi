/**
* Template Name: Medicio
* Updated: Mar 10 2023 with Bootstrap v5.2.3
* Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  const headerScrolled = () => {
  if (window.scrollY > 100) {
    selectHeader.classList.add('header-scrolled');
    if (selectTopbar) {
      selectTopbar.classList.add('topbar-scrolled');
    }
    if (logoImg) {
      logoImg.style.height = "40px";
    }
  } else {
    selectHeader.classList.remove('header-scrolled');
    if (selectTopbar) {
      selectTopbar.classList.remove('topbar-scrolled');
    }
    if (logoImg) {
      logoImg.style.height = "60px";
    }
  }
}


window.addEventListener('scroll', function() {
  const header = document.getElementById('header');
  if(window.scrollY > 50){
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});



window.addEventListener('scroll', function () {
  const selectHeader = document.querySelector('#header');
  if (window.scrollY > 100) {
    selectHeader.classList.add('scrolled');
  } else {
    selectHeader.classList.remove('scrolled');
  }
});



  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  let selectTopbar = select('#topbar')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.add('topbar-scrolled')
        }
      } else {
        selectHeader.classList.remove('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.remove('topbar-scrolled')
        }
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Hero carousel indicators
   */
  let heroCarouselIndicators = select("#hero-carousel-indicators")
  let heroCarouselItems = select('#heroCarousel .carousel-item', true)

  heroCarouselItems.forEach((item, index) => {
    (index === 0) ?
    heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "' class='active'></li>":
      heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "'></li>"
  });

  /**
   * Testimonials slider
   */
  new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },

      1200: {
        slidesPerView: 3,
        spaceBetween: 20
      }
    }
  });

  /**
   * Clients Slider
   */
  new Swiper('.gallery-slider', {
    speed: 400,
    loop: true,
    centeredSlides: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },
      640: {
        slidesPerView: 3,
        spaceBetween: 20
      },
      992: {
        slidesPerView: 5,
        spaceBetween: 20
      }
    }
  });

  /**
   * HAPUS/COMMENT GLightbox - Karena menyebabkan popup double
   */
  // const galleryLightbox = GLightbox({
  //   selector: '.gallery-lightbox'
  // });

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

})()

new Swiper('.link-swiper', {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    loop: true
  });

  //pagination link terkait
document.addEventListener('DOMContentLoaded', function () {
  var linkSwiper = new Swiper('.link-swiper', {
    slidesPerView: 5, // jumlah gambar terlihat di desktop
    spaceBetween: 20, // jarak antar gambar
    centeredSlides: true, // selalu posisikan slide aktif di tengah
    loop: true, // agar berputar terus
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    breakpoints: {
      0: { slidesPerView: 2 },
      768: { slidesPerView: 3 },
      992: { slidesPerView: 5 }
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
      // Fungsi untuk memuat konten secara dinamis
      function loadContent(url, targetId) {
        fetch(url)
          .then(response => response.text())
          .then(html => {
            document.getElementById(targetId).innerHTML = html;
            // Scroll ke bagian yang dituju
            document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
          })
          .catch(err => console.error('Gagal memuat konten:', err));
      }

      // Tangani klik pada semua link navbar
      document.querySelectorAll('#navbar a').forEach(link => {
        link.addEventListener('click', function(e) {
          // Jika link memiliki href yang dimulai dengan # (anchor link)
          if (this.getAttribute('href').startsWith('#')) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
              targetElement.scrollIntoView({ behavior: 'smooth' });
            }
          }
          // Jika link mengarah ke route lain (misal: profil)
          else if (this.getAttribute('href').startsWith('{{ route') ||
                   !this.getAttribute('href').startsWith('http')) {
            e.preventDefault();
            const url = this.getAttribute('href');
            // Memuat konten ke dalam main
            loadContent(url, 'main');
          }
          // Link eksternal dibiarkan normal
        });
      });

      // Tangani perubahan URL saat menggunakan tombol back/forward browser
      window.addEventListener('popstate', function() {
        loadContent(window.location.pathname, 'main');
      });
    });

/* ========================================
   ENHANCED MODAL POPUP WITH NAVIGATION
======================================== */

// Gallery navigation variables
let galleryImages = [];
let currentImageIndex = 0;

// Initialize gallery images from page
function initializeGallery() {
    // Collect all gallery images with their data
    const galleryElements = document.querySelectorAll('[onclick*="showImagePopup"]');
    galleryImages = [];

    galleryElements.forEach((element, index) => {
        const onclickValue = element.getAttribute('onclick');
        // Extract image source and title from onclick attribute
        const matches = onclickValue.match(/showImagePopup\('([^']+)',\s*'([^']+)'\)/);
        if (matches) {
            galleryImages.push({
                src: matches[1],
                title: matches[2],
                element: element
            });
        }
    });

    console.log('✅ Gallery initialized with', galleryImages.length, 'images');
}

// Enhanced function to show popup with navigation
function showImagePopup(imageSrc, imageTitle, elementClicked = null) {
    // Initialize gallery if not done yet
    if (galleryImages.length === 0) {
        initializeGallery();
    }

    // Find current image index
    currentImageIndex = galleryImages.findIndex(img => img.src === imageSrc);
    if (currentImageIndex === -1) {
        currentImageIndex = 0;
    }

    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');
    const titleElement = document.getElementById('imageTitle');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const counter = document.getElementById('imageCounter');

    // Set gambar dan judul
    modalImg.src = imageSrc;
    modalImg.alt = imageTitle;
    titleElement.textContent = imageTitle;

    // Update counter
    if (counter) {
        counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
    }

    // Show/hide navigation buttons
    if (prevBtn && nextBtn) {
        prevBtn.style.display = galleryImages.length > 1 ? 'block' : 'none';
        nextBtn.style.display = galleryImages.length > 1 ? 'block' : 'none';
    }

    // Tampilkan modal
    modal.style.display = 'block';

    // Prevent body scrolling
    document.body.style.overflow = 'hidden';

    console.log('✅ Popup opened:', imageTitle, 'Index:', currentImageIndex);
}

// Navigate to previous image
function showPreviousImage() {
    if (galleryImages.length === 0) return;

    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    const prevImage = galleryImages[currentImageIndex];

    updateModalContent(prevImage.src, prevImage.title);
}

// Navigate to next image
function showNextImage() {
    if (galleryImages.length === 0) return;

    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    const nextImage = galleryImages[currentImageIndex];

    updateModalContent(nextImage.src, nextImage.title);
}

// Update modal content without closing
function updateModalContent(imageSrc, imageTitle) {
    const modalImg = document.getElementById('modalImg');
    const titleElement = document.getElementById('imageTitle');
    const counter = document.getElementById('imageCounter');

    // Add loading state
    modalImg.style.opacity = '0.5';

    // Update image
    modalImg.onload = function() {
        modalImg.style.opacity = '1';
    };

    modalImg.src = imageSrc;
    modalImg.alt = imageTitle;
    titleElement.textContent = imageTitle;

    // Update counter
    if (counter) {
        counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
    }

    console.log('✅ Modal updated:', imageTitle, 'Index:', currentImageIndex);
}

// Function untuk menutup popup
function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';

    // Restore body scrolling
    document.body.style.overflow = 'auto';

    console.log('✅ Popup closed');
}

// Enhanced keyboard navigation
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('imageModal');
    if (modal && modal.style.display === 'block') {
        switch(event.key) {
            case 'Escape':
                closeImageModal();
                break;
            case 'ArrowLeft':
                event.preventDefault();
                showPreviousImage();
                break;
            case 'ArrowRight':
                event.preventDefault();
                showNextImage();
                break;
        }
    }
});

// Prevent modal close when clicking on content
document.addEventListener('DOMContentLoaded', function() {
    // Initialize gallery when page loads
    setTimeout(() => {
        initializeGallery();
    }, 1000);

    const modalWrapper = document.querySelector('.modal-content-wrapper');
    if (modalWrapper) {
        modalWrapper.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    // Setup navigation button event listeners
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            showPreviousImage();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            showNextImage();
        });
    }
});

// Close modal ketika klik di area hitam (background)
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeImageModal();
            }
        });
    }
});

// Touch/swipe support for mobile
let touchStartX = 0;
let touchEndX = 0;

document.addEventListener('DOMContentLoaded', function() {
    const modalImg = document.getElementById('modalImg');
    if (modalImg) {
        modalImg.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        modalImg.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });
    }
});

function handleSwipe() {
    const swipeThreshold = 50;
    const swipeDistance = touchEndX - touchStartX;

    if (Math.abs(swipeDistance) > swipeThreshold) {
        if (swipeDistance > 0) {
            // Swipe right - show previous
            showPreviousImage();
        } else {
            // Swipe left - show next
            showNextImage();
        }
    }
}
