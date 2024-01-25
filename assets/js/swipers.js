function formatColorName(slug) {
  return slug
    .split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ');
}

function heroSwiper() {
  var swiperHero = new Swiper(".swiperHero", {
    slidesPerView: 1,
    loop: true,
    autoplay: {
      delay: 5000,
    },
    pagination: {
      el: ".swiper-pagination-hero",
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + ' custom-pagination-bullet" data-slide-index="'+ (index + 1) +'"><span class="pagination-inner-bullets"></span></span>';
      }
    },
    navigation: {
      nextEl: ".swiper-navigation-hero-next",
    },
  });

  function adjustPaginationWidth() {
    var screenWidth = window.innerWidth * 0.7; // 80% de la largeur de l'écran
    var numSlides = swiperHero.slides.length; // Nombre de diapositives dans le carrousel
    var paginationBullets = document.querySelectorAll(".custom-pagination-bullet");

    var bulletWidth = screenWidth / numSlides + "px";

    paginationBullets.forEach(function (bullet) {
      bullet.style.width = bulletWidth;
    });
  }

// Appelez la fonction pour ajuster la largeur initiale de la pagination
  adjustPaginationWidth();

// Écoutez le redimensionnement de la fenêtre pour ajuster la largeur lorsque la taille de l'écran change
  window.addEventListener("resize", adjustPaginationWidth);
}
function expoSwiper() {
  var swiperExpos = new Swiper(".swiperExpos", {
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination-expos",
      clickable: true,
      loop: true,
    },
    navigation: {
      nextEl: ".swiper-navigation-expos-next",
    },
    breakpoints: {
      1024: {
        slidesPerView: "auto",
      },
    },
    on: {
      init: function () {
      }
    }
  });
}

function artworksFilterSwiper() {
  if (window.matchMedia('(max-width: 1024px)').matches) {
    var container = document.querySelector("#artworks-filters")
    var subContainer = document.querySelector("#artworks-filters-sub")
    var filters = document.querySelectorAll(".filter-button")
    if (container) {
      container.classList.add('swiperArtworks')
      container.classList.add('swiper')
    }
    if (subContainer) {
      subContainer.classList.add('swiper-wrapper')
    }
    if (filters.length) {
      for (let i = 0; i < filters.length; i++) {
        filters[i].classList.add('swiper-slide')
      }
    }
    var swiperArtworks = new Swiper(".swiperArtworks", {
      slidesPerView: "auto",
      loop: false,
    });
  }
}

function productSwiper() {
  var swiperProduct = new Swiper(".swiperProduct", {
    spaceBetween: 10,
    slidesPerView: 2,
    freeMode: false,
    watchSlidesProgress: true,
  });
  var swiperProductThumbs = new Swiper(".swiperProductThumbs", {
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-navigation-hero-next",
      prevEl: ".swiper-navigation-hero-prev",
    },
    thumbs: {
      swiper: swiperProduct,
    },
  });

  var colorRadioButtons = document.querySelectorAll('input[class="variation-color"]');
  function updateSliderForColor(colorSlug, swiperInstance) {
    var swiperContainer = document.querySelector('.swiperProductThumbs');
    var slides = swiperContainer.querySelectorAll('.swiper-slide');
    var slider = swiperInstance;

    var slideIndex = -1;
    for (var i = 0; i < slides.length; i++) {
      if (slides[i].getAttribute('data-color') === colorSlug) {
        slideIndex = i;
        break;
      }
    }

    if (slideIndex !== -1) {
      slider.slideTo(slideIndex);
    }
  }
  colorRadioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
      if (this.checked) {
        updateSliderForColor(this.value, swiperProductThumbs);
        var selectedColorName = formatColorName(this.value);
        var selectedColorSpan = document.querySelector('.selected-color');
        if (selectedColorSpan) {
          selectedColorSpan.textContent = selectedColorName;
        }
      }
    });
  });
}

function collaborationsFilterSwiper() {
  if (window.matchMedia('(max-width: 1024px)').matches) {
    var container = document.querySelector("#collaborations-filters")
    var subContainer = document.querySelector("#collaborations-filters-sub")
    var filters = document.querySelectorAll(".collaboration-filter-button")
    if (container) {
      container.classList.add('swiperCollaborationsFilters')
      container.classList.add('swiper')
    }
    if (subContainer) {
      subContainer.classList.add('swiper-wrapper')
    }
    if (filters.length) {
      for (let i = 0; i < filters.length; i++) {
        filters[i].classList.add('swiper-slide')
      }
    }
    var swiperCollaborationsFilters = new Swiper(".swiperCollaborationsFilters", {
      slidesPerView: "auto",
      loop: false,
    });
  }
}

function collaborationsGallerySwiper() {
  var swiperCollaborationGallery = new Swiper(".swiperCollaborationGallery", {
    slidesPerView: "auto",
    spaceBetween: 5,
    loop: false,
    on: {
      init: function () {
      }
    }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  const body = document.querySelector('body')
  if (body.classList.contains('home')) {
    heroSwiper()
    expoSwiper()
  }
  if (body.classList.contains('page-template-artworks')) {
    artworksFilterSwiper()
  }
  if (body.classList.contains('single-product')) {
    productSwiper()
  }
  if (body.classList.contains('page-template-collaborations')) {
    collaborationsFilterSwiper()
    collaborationsGallerySwiper()
  }
})