@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'العملاء')

@section('content')
@livewire('live-wire-customers')
@endsection

@push('js')
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example',{
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/ar.json',
            },
        });
    </script>
@endpush