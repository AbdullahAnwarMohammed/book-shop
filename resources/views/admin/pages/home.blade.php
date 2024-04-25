@extends('admin.layouts.home.master')
@section('title',isset($title) ? $title : 'الرئيسية')
@push('css')
  <link rel="stylesheet" href="{{ asset('plugins/tagify/tagify.css') }}">
@endpush
@section('content')

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            @if (Auth::guard('admin')->check())
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-category"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v6h-6z" /><path d="M14 4h6v6h-6z" /><path d="M4 14h6v6h-6z" /><path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg>                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          الاقسام [{{ \App\Models\Category::count() }}]
                        </div>
                        <div class="text-secondary">
                          <span class="badge bg-success-lt"> مفعل : {{ \App\Models\Category::where('active','1')->count() }} </span>
                          ||
                          <span class="badge bg-pink-lt">  غير مفعل : {{ \App\Models\Category::where('active','0')->count() }} </span>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-books"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M5 8h4" /><path d="M9 16h4" /><path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" /><path d="M14 9l4 -1" /><path d="M16 16l3.923 -.98" /></svg>                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          الكتب [{{ \App\Models\Book::count() }}]
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          البائعين [{{ \App\Models\User::count() }}]
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-lime text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 12a9 9 0 1 0 -8.012 8.946" /><path d="M9 10h.01" /><path d="M15 10h.01" /><path d="M9.5 15a3.59 3.59 0 0 0 2.774 .99" /><path d="M18.994 21.5l2.518 -2.58a1.74 1.74 0 0 0 .004 -2.413a1.627 1.627 0 0 0 -2.346 -.005l-.168 .172l-.168 -.172a1.627 1.627 0 0 0 -2.346 -.004a1.74 1.74 0 0 0 -.004 2.412l2.51 2.59z" /></svg>                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          العملاء [{{ \App\Models\Customer::count() }}]
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              @livewire('manger-live-wire-home')
            @endif
             
            @if (Auth::guard('web')->check())
                <!-- Modal Add New Customers -->
               @livewire('user-live-wire')
            @endif
        </div>
    </div>
   
    
</div>




@endsection

@push('js')
  <script src="{{ asset('plugins/tagify/jQuery.tagify.min.js') }}"></script>

  <script>
    $(function(){
      function copyToClipboard(text) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
      }
      
      // Copy Hash
      $(document).on("click","#copy",function(){
        var attributeValue = $(this).attr("data-hash"); // Change 'data-attribute' to the attribute you want to copy
        copyToClipboard(attributeValue);
        toastr.success('تم النسخ بنجاح')

      })
    

      $('#fav').tagify();


      $("#FormAddNewCustomers").submit(function(e){

      e.preventDefault();
      let tags = [];
      $(".tagify__tag ").each(function(item){
        tags.push($(this).attr("value"));
      })
      $("[name=fav]").val(tags.join(","));

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
        console.log(response)
        if(response.code == 1)
        {
            $(form)[0].reset();
            $(".modal_customer_add").modal("hide")
            toastr.success(response.msg);
        }
        else 
        {
            toastr.error(response.msg);
        }
      },
      error:function(response)
      {
        toastr.remove();
        console.log(response)
        $.each(response.responseJSON.errors,function(prefix,val){
            $(form).find("span."+prefix+"_error").html(val[0])
        })
      }
    })

      
      });




        
   


    })

  </script>
@endpush