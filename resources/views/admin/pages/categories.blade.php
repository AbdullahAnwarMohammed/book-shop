@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'الرئيسية')
@section('content')
  @livewire('categories')
@endsection
@push('js')
<script>
     $(window).on("hidden.bs.modal",function(){
        Livewire.dispatch('resetModalForm');
       });
       
    window.addEventListener("hideCategoryModal",function(e){
        $("#ModalAddNewCategory").modal("hide")
    })


    window.addEventListener("hideEditCategoryModal",function(e){
        $("#ModalEditCategory").modal("hide")
    })

    


    window.addEventListener("deleteCategory",function(event){
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
            Livewire.dispatch("deleteCategoryAction",{id:event.detail[0].id})
        }
        });
    });


    window.addEventListener("showEditCategoryModal",function(){
  
        $("#ModalEditCategory").modal('show')
    })

    // window.addEventListener("hideEditAuthorModal",function(){
    // $("#ModalEditCategory").modal('hide')
    // })



</script>
@endpush