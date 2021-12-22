<nav class="navbar navbar-expand-xl fixed-top">
  <div class="navbar-top-wrapper container">
    <a class="navbar-brand"  href="{{ route('site.inicio') }}">
      <img id="navbar-brand" src="/img/logo/Logo-vivamed-colorida.png" alt="alt text for screen readers">
      {{-- <img src="/img/logo/logo-sm.png" alt="alt text for screen readers" class="d-none d-sm-block d-xl-none"> --}}
    </a>

    <div class="menu-top-wrapper d-flex ">
      <div class="d-flex border-file pe-4 me-5">

        <div class="me-5 d-none d-xl-block">
          <a class="d-flex align-items-center" href="https://api.whatsapp.com/send?phone=5591993882929&text=Quero%20agendar%20uma%20consulta:)">
            <div class="circle-greenLight d-flex align-items-center justify-content-center me-3">
              <img src="/img/icons/Icon-time.png" alt="Icon time">
            </div>
          Agendar Consulta
          </a>
        </div>
       

        <div class="d-none d-xl-block">
          <a class="d-flex align-items-center" href="https://api.whatsapp.com/send?phone=5591993882929&text=Quero%20saber%20sobre%20resultado%20de%20exames%20:)">
            <div class="border-file circle-greenDark d-flex align-items-center justify-content-center me-3">
              <img src="/img/icons/Icon-file-plus.png" alt="Icon file"> 
            </div>
            Resultados de Exames
          </a>
        </div>
      </div>
      
      {{-- <div class="d-flex align-items-center me-5">
        <a class="d-none d-xl-block" href="#">
          <div class="circle-greenLight d-flex align-items-center justify-content-center">
            <img src="/img/icons/Icon-cart.png" alt="Icon cart"> 
          </div>
        </a>
      </div> --}}
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
      <div class="menu-bar bar-1"></div>
      <div class="menu-bar bar-2"></div>
      <div class="menu-bar bar-3"></div>
    </button>
  </div> {{-- end container --}}

  <div class="collapse navbar-collapse" id="menu">
    <div class="container">
      <div class="navbar-wrapper">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('site.inicio') }}">
              Home
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('site.pages.consultas') }}">
              Consultas
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('site.pages.exames') }}">
              Exames
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('site.pages.combos') }}">
              Combos
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('site.pages.location') }}">
              Onde Estamos
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('site.blog.index') }}">
              Blog
            </a>
          </li>
        </ul> 

        <a id="button-whatsapp-submenu" href="https://api.whatsapp.com/send?phone=5591993882929&text=Fale%20com%20a%20VIDAMED:)" target="_blank" rel="noopener">
          <button class="btn-whatsapp-menu"><i class="fab fa-whatsapp me-3"></i> (91) 99388-2929</button>
        </a>
      </div>
      
      
      
    </div> {{-- end container --}}
  </div>
</nav>
