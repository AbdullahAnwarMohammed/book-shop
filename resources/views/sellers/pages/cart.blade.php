@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'السجل')
@section('content')
@livewire('cart-live-wire')
@endsection