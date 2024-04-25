@extends('admin.layouts.auth.master')
@section('title', isset($title) ? $title : "Login Page")
@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
          <img src="/admin/dist/static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
      </div>
      <div class="card card-md">
        
        <div class="card-body">
          <h2 class="h2 text-center mb-4">قم بتسجيل الدخول</h2>
          @if (Session::has('fail'))
              <div class="alert alert-danger">{{ Session::get('fail') }}</div>
          @endif
            @livewire('admin-login')
        </div>
      
      </div>
      
    </div>
  </div>
@endsection