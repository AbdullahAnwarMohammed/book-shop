<div>
    

  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          
          <h2 class="page-title">
            <span class="d-block m-2">الاقسام</span> <span class="badge bg-success-lt">{{ $count }}</span>
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            @if (Auth::guard("admin")->check())

            <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="Good" data-bs-toggle="modal" data-bs-target="#ModalAddNewCategory">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
              قسم جديد
            </a>

            @endif
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <input type="search" wire:model="search" wire:keydown="handlerSearch()" class="form-control" placeholder="مثال : رويات">
        </div>
        @forelse ($Categories as $Item)
          
        
          
          
      <div class="col-md-6 col-lg-3">
          <div class="card">
            <div class="card-body p-4 text-center">
              <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg)">{{ substr($Item->name,0,2) }}</span>
              <h3 class="m-0 mb-1"><a href="#">{{ $Item->name }}</a></h3>
              <div class="mt-3">
                <span class="badge bg-info-lt">{{ $Item->books->count() }}</span>
                <span class="badge {{ $Item->active == 1 ? "bg-success-lt" : "bg-danger-lt" }}  ">{{ $Item->active == 1 ? "مفعل" : "غير مفعل" }}</span>
              </div>
            </div>
            @if (Auth::guard('admin')->check())
            <div class="d-flex">
              <a href="#"  wire:click.prevent="editCategory({{ $Item }})"  class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M11.35 17.39l-4.35 2.61v-14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v6"></path><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path></svg>تعديل</a>
             
                <a href="#" wire:click.prevent="deleteCategory({{ $Item }})" class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                حذف</a>
            </div>
            @endif
           
          </div>
        </div>
        @empty
        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
          <div class="d-flex">
            <div>
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
            </div>
            <div>
              لا يوجد بيانات
            </div>
          </div>
          <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endforelse
  
  
      </div>
      <div class="row mt-4">
        {{ $Categories->links('livewire::simple-bootstrap') }}
      </div> 
      
      <!-- Modal Add New Category -->
      <div wire:ignore.self class="modal modal-blur fade" id="ModalAddNewCategory"  data-bs-backdrop="static" datab-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">اضافة قسم جديد</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="FormAddNewCategory" method="POST" wire:submit.prevent="HandlerAdd()">
                <div class="mb-3">
                    <label class="form-label">اسم القسم</label>
                    <input type="text" class="form-control" wire:model="name" placeholder="رويات">
                    @error('name')
                        <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                  </div>
        
                  <div class="mb-3">
                    <div class="form-label">تفعيل</div>
  
                    <label class="form-check form-switch">
                        <input class="form-check-input" wire:model="active" name="active" type="checkbox" checked="">
                    </label>
                   
                  </div>
        
        
                  <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary" >حفظ</button>
                  </div>
        
            </form>
            </div>
            
          </div>
        </div>
      </div>
  
      <!-- Modal Edit --> 
      
      <!-- Add New Category -->
      <div wire:ignore.self class="modal modal-blur fade" id="ModalEditCategory"  data-bs-backdrop="static" datab-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">تعديل قسم {{ $name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="FormUpdateategory" method="POST" wire:submit.prevent="HandlerUpdate()">
                <div class="mb-3">
                    <label class="form-label">اسم القسم</label>
                    <input type="text" class="form-control" wire:model="name" placeholder="رويات">
                    @error('name')
                        <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                  </div>
        
                  <div class="mb-3">
                    <div class="form-label">تفعيل</div>
  
                    <label class="form-check form-switch">
                        <input class="form-check-input" wire:model="active"   @checked($active == 1) type="checkbox">
                    </label>
                   
                  </div>
        
        
                  <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary" >حفظ</button>
                  </div>
        
            </form>
            </div>
            
          </div>
        </div>
      </div>
  
    </div>
  </div>

       
</div>
