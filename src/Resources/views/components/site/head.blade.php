
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175491243-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175491243-1');
  gtag('config', 'AW-821072542');
</script>

<!-- Event snippet for [Views] Home novo site conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-821072542/KukSCKCr8t0BEJ6lwocD'});
</script>

<!-- Global site tag (gtag.js) - Google Ads: 821072542 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-821072542"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-821072542');
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="Bredi - http://www.bredi.com.br">

<title>{{ env('APP_NAME') }}</title>

{{-- SEO --}}
@component('components.site.seo')
@endcomponent

{{-- site theme --}}
<meta name="msapplication-navbutton-color" content="#FFFFFF"/>
<meta name="apple-mobile-web-app-capable" content="yes">

<meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">
<meta name="theme-color" content="#FFFFFF">

{{-- favicon --}}
<link rel="icon" sizes="192x192" href="/img/favicon.ico">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon"/>

{{-- fonts --}}
<link href="/fonts/fonts.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">


{{--  custom stylesheets  --}}
<link href="{{ asset('/css/site/custom.css') }}" rel="stylesheet" media/>
<link href="{{ asset('/css/site/extra.css') }}" rel="stylesheet" media/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

{{--  page styles  --}}
@yield('styles')
