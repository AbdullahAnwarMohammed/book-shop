
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link href="/admin/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      input,button{
        font-family: "Cairo", sans-serif !important;

      }
      body {
        font-family: "Cairo", sans-serif;

        direction: rtl;
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    @livewireStyles
    @stack('css')
  </head>
  <body  class=" d-flex flex-column">
    <script src="/admin/dist/js/demo-theme.min.js?1692870487"></script>
    @yield('content')
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/admin/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/admin/dist/js/demo.min.js?1692870487" defer></script>
    @livewireScripts
    @stack('js')
  </body>
</html>