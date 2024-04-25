@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'الرئيسية')
@section('content')
@livewire('sellers')
@endsection

@push('js')
    <script>
        window.addEventListener("hideModalAddSeller",function(e){
            $("#form_add_new_seller")[0].reset();
            $("#modal_add_new_seller").modal("hide")
        })
        window.addEventListener("hideModalAddSeller",function(e){
            $("#form_add_new_seller")[0].reset();
            $("#modal_add_new_seller").modal("hide")
        })

        window.addEventListener("deleteeSeller",function(event){
        Swal.fire({
        title: event.detail[0].title,
        text: event.detail[0].html,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "حذف"
        }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch("deleteSellerAction",{id:event.detail[0].id})
        }
        });
    });
    window.addEventListener("showEditSellerModal",function(event){
        $("#modal_edit_seller").modal('show')
    });

    window.addEventListener("hideEditSellerModal",function(event){
        $("#modal_edit_seller").modal('hide')
    });
    
    

        
    </script>
@endpush