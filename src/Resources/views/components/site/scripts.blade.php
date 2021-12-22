{{--  custom scripts  --}}
<script type="text/javascript" src="/js/site/custom.js?v=3"></script>
<noscript>Your browser is outdated or does not support JavaScript</noscript>

<script>
  new WOW().init();
</script>

<!-- script to remove active class from header menu -->
<script>
  const navLink = document.querySelectorAll('.nav-link')
  navLink.forEach(function (el) {
    el.parentNode.classList.remove('active')
    if(el.pathname === location.pathname && el.hash === location.hash) {
      el.parentNode.classList.add('active')
    }
  })
</script>




{{-- script to control the height of the menu --}}
<script>
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      document.getElementById("menu").style.height = "50px";
      document.getElementById("navbar-brand").style.width = "190px";
      document.getElementById("button-whatsapp-submenu").style.display = "none";
    } else {
      document.getElementById("menu").style.height = "70px";
      document.getElementById("navbar-brand").style.width = "246px";
      document.getElementById("button-whatsapp-submenu").style.display = "block";
    }
  }
</script>

{{-- script swipper brands-carousel --}}
<script>
  var swiper = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    loop: true,
    autoplay: {
    delay: 2000,
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 10,
        },
    },
  });
</script>

{{--  page scripts  --}}

@yield('scripts')
