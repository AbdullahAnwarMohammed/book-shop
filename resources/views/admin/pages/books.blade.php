@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'الكتب')

@section('content')

  @livewire('books')
@endsection
@push('js')
<script>


    $("#form_add_new_category").submit(function(e){
    e.preventDefault();
    
    var form = this;
    var formData = new FormData(form);
    $.ajax({
      url : $(form).attr("action"),
      method : $(form).attr("method"),
      data: formData,
      processData: false,
      dataType:'json',
      contentType:false,
      beforeSend:function(){
        $(form).find("span.text-danger").text("")
      },
      success:function(response){
        toastr.remove();
        if(response.code == 1)
        {
            $(form)[0].reset();
            $(".modal_books").modal("hide")
            toastr.success(response.msg);
            Livewire.dispatch("refreshBooks")
        }
        else 
        {
            toastr.error(response.msg);
        }
      },
      error:function(response)
      {
        toastr.remove();
        $.each(response.responseJSON.errors,function(prefix,val){
            $(form).find("span."+prefix+"_error").html(val[0])
        })
      }
    })
  });

      // حذف الكتاب
      window.addEventListener("deleteBook",function(event){
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
            Livewire.dispatch("deleteBookAction",{id:event.detail[0].id})
        }
        });
    });

    window.addEventListener("showEditBookModal",function(event){
        $("#modal_update_book").modal('show')
    });

    window.addEventListener("hideEditBookModal",function(event){
        $("#modal_update_book").modal('hide')
    });
    
    // Sell Book
    
    window.addEventListener("showWizzardSellBook",function(event){
        $("#modal_sell_book").modal('show')
    });

    window.addEventListener("hideWizzardSellBook",function(event){
        $("#modal_sell_book").modal('hide')
    });

    $(window).on("hidden.bs.modal",function(){
        Livewire.dispatch('resetModalForm');
       });
       
       
    






</script>
@endpush