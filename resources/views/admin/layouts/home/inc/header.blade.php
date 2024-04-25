
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en" dir="rtl" >
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <!-- CSS files -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/admin/dist/css/tabler.rtl.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/tabler-flags.rtl.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/tabler-payments.rtl.min.css?1692870487" rel="stylesheet"/>
    <link href="/admin/dist/css/tabler-vendors.rtl.min.css?1692870487" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')

    <link href="/admin/dist/css/demo.rtl.min.css?1692870487" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body,a,button,input,select{
        font-family: "Cairo", sans-serif !important;

      }
      body {

      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      .tagify {
        border: none !important;

      }
      .tagify__input
      {
        font-family: "Cairo", sans-serif !important;
      }
     
     
    </style>
  </head>
  <body >
    <script src="/admin/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-book-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg> مكتبتي 
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              {{-- <div class="btn-list">
                <a href="https://github.com/tabler/tabler" class="btn" target="_blank" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                  Source code
                </a>
                <a href="https://github.com/sponsors/codecalm" class="btn" target="_blank" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Sponsor
                </a>
              </div> --}}
            </div>
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
        
           
            
@if (Auth::guard('admin')->check())
<div class="nav-item dropdown d-none d-md-flex me-3">
  @livewire('notification')
  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
   <div class="card">
     <div class="card-header">
       <h3 class="card-title">الاشعارات</h3>
     </div>
     <div class="list-group list-group-flush list-group-hoverable">
      
       <div class="list-group-item">
        @php
        $admin = Auth::guard('admin')->user();
      $unreadNotifications = $admin->unreadNotifications;
      @endphp
         @foreach ($unreadNotifications as $item)
         <div class="row align-items-center">
           <div class="col-auto"><span class="status-dot status-dot-animated bg-green d-block"></span></div>
           <div class="col text-truncate">
             <a href="#" class="text-body d-block">
               @switch($item->data['type'])
               @case('cash')
                 بوابة دفع || <span>{{ $item->data['name'] }}</span>
                 @break
             
               @default
                 
             @endswitch
             </a>
             <div class="d-block text-secondary text-truncate mt-n1">
               {{ $item->data['price'] }} جنية
  
             </div>
           </div>
           <div class="col-auto">
             <a href="#" class="list-group-item-actions">
               <!-- Download SVG icon from http://tabler-icons.io/i/star -->
               <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
             </a>
           </div>
         </div>
         @endforeach
         
       </div>
     </div>
   </div>
  </div>
  </div>
@endif


            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(/admin/dist/static/avatars/000m.jpg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{ Auth::guard('admin')->check() ? Auth::guard('admin')->name : Auth::user()->name }}</div>
                  <div class="mt-1 small text-secondary">{{ Auth::guard('admin')->check() ? 'Manger' : 'Seller'}}</div>
                </div>
              </a>
              @php
                $prefix = Auth::guard('admin')->check() ? "admin." : "";
              @endphp

              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="./profile.html" class="dropdown-item">الصفحة الشخصية</a>
                <div class="dropdown-divider"></div>
                <a href="./settings.html" class="dropdown-item">الاعدادت</a>
                <a href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit()" class="dropdown-item">تسجيل الخروج</a>
                <form action="{{ route($prefix."logout") }}" id="logout-form" method="POST">
                  @csrf
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>

      