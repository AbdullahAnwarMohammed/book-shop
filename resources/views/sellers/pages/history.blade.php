@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'السجل')
@section('content')
    @livewire('history')
@endsection