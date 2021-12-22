<div class="news-card">
  <div class="card-img">
    <a href="{{ route('site.noticias.detalhe') }}" style="
      background: url(/img/site/elements/news/1.jpg) no-repeat center;
      background-size: cover;
    "></a>
  </div>
  <div class="card-content">
    <a href="{{ route('site.noticias.detalhe') }}" class="title">Papão finaliza trabalhos para enfrentar o Boa Esporte-MG</a>

    <div class="buttons">
      <div class="block">
        <a href="{{ route('site.noticias.detalhe') }}" class="btn-outline --arrow-right">Ler mais</a>
      </div>

      <div class="block">
        {{-- <a href="{{ route('site.noticias.index') }}" class="card-filter"> --}}
          <img src="/img/site/icons/futeball.svg" alt="futebol">
          <span class="text">Futebol</span>
        </a>
      </div>
    </div>
  </div>
</div> <!-- end news-card -->