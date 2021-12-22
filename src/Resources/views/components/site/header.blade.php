<nav class="navbar navbar-expand-xl fixed-top">
  <a class="navbar-brand" href="{{ route('site.index.index') }}">
    {{-- <img src="/img/logo/logo.svg" alt="alt text for screen readers" class="d-none d-xl-block aa"> --}}
    {{-- <img src="/img/logo/logo-sm.svg" alt="alt text for screen readers" class="d-block d-xl-none aa"> --}}
    logo.
  </a>

  <button class="navbar-toggler" type="button"
    data-toggle="collapse" data-target="#menu"
    aria-controls="menu" aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <div class="menu-bar bar-1"></div>
    <div class="menu-bar bar-2"></div>
    <div class="menu-bar bar-3"></div>
  </button>

  <div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('site.inicio') }}">
          Home
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('site.pages.about') }}">
          About
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('site.pages.faq') }}">
          FAQ
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('site.blog.index') }}">
          Blog
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Options
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">
            Link
          </a>

          <a class="dropdown-item" href="#">
            Another Link
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="#">
            Something else here
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">
          Launch modal
        </a>
      </li>

       <li class="nav-item">
        <a class="nav-link" href="{{ route('site.pages.contact') }}">
          Contact
        </a>
      </li>
    </ul>
  </div>
</nav>
