<div>
  <div class="col-12 ">
    <div class="row">

      <div class="col-8">
        <a href="#"   class="btn btn-teal "  data-bs-toggle="modal" data-bs-target="#modal_add_new_customers">
          <i class="fa-solid fa-square-plus d-block mx-1"></i>
          اضافة عميل
         </a>
        <div class="row">
          <div class="col-12 my-2">
           <div class="accordion" id="accordion-example">
            <div class="accordion-item">
              <h2 class="accordion-header" id="heading-1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false">
                  الخزانة 
                </button>
              </h2>
              <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                <div class="accordion-body pt-0">
                  <input type="date" wire:change="Cabinet()" wire:model="date" class="form-control my-4">
                  @php
                    $Profit = 0;
                  @endphp  
                  @foreach ($purchases as $item)
                    @if ($item['recovery'] == 0)
                      @php
                              $Profit += $item['cost']
                      @endphp
                    @endif
                   
                  @endforeach
                  <div class="alert alert-{{ $Profit  > 0 ? "success" : "danger" }}">صافي الرابح : {{ $Profit  > 0 ? $Profit." جنية" : "الخزانة فارغة" }} </div>
                  <button class="btn">مبيعات <span class="badge bg-blue text-blue-fg ms-2">{{ count($purchases) }}</span></button>
                  <button class="btn">عمليات ناجحة  <span class="badge bg-success text-blue-fg ms-2">{{ $recoveryFalse }}</span></button>
                  <button class="btn">استرجاع <span class="badge bg-danger text-blue-fg ms-2">{{ $recoveryTrue }}</span></button>
                </div>
              </div>
            </div>
           </div>
          </div>
        </div>
      
    
         <input type="search" class="form-control my-2" wire:keydown="search_customers()" wire:model="search_customer" placeholder="البحث عن عميل">
         <div class="row">

         @forelse ($Customers as  $Item)
          <div class="col-md-6 col-xl-3 my-2">
            <div class="card">
              <div class="card-body text-center">
                <div class="mb-3">
                  <span class="avatar avatar-xl rounded">{{ Str::substr($Item->name, 0, 1) }}</span>
                </div>
                <div class="card-title mb-1">{{ $Item->name }}</div>
                <div class="text-secondary"><span class="badge bg-success-lt">{{ $Item->cash }} جنية</span></div>
              </div>
              <a href="#" id="copy" data-hash="{{ $Item->hash }}"  class="card-btn"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-copy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg> نسخ الرمز </a>
            </div>
          </div>
    @empty
    @if ($show)
    <div class="alert alert-warning alert-dismissible my-4" role="alert">
      <div class="d-flex">
        <div>
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
        </div>
        <div>
          لا يوجد بيانات
        </div>
      </div>
      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
    @endif
   

    @endforelse
  </div>

      </div>
      <div class="col-4">
        <h2>مبيعات اليوم</h2>
        <div class="card">
          <div class="ribbon ribbon-top bg-info"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
          </div>
          <div class="card-body">
            <h3 class="card-title">مبيعات اليوم <span class="badge bg-info-lt">{{ count($purchases) }}</span></h3>
          </div>
        </div>
        <div class="card my-1">
          <div class="ribbon ribbon-top bg-success"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>          </div>
          <div class="card-body">
            <h3 class="card-title">عمليات ناجحة <span class="badge bg-success-lt">{{ $recoveryFalse }}</span></h3>
          </div>
        </div>
        <div class="card">
          <div class="ribbon ribbon-top bg-danger"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-look-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M9 13h.01" /><path d="M15 13h.01" /><path d="M11 17h2" /></svg>          </div>
          <div class="card-body">
            <h3 class="card-title">استرجاع <span class="badge bg-warning-lt">{{ $recoveryTrue }}</span></h3>
          </div>
        </div>
      </div>
    </div>
   
     
  </div>

  <div class="col-12 my-2">
    <div class="row">


  </div>

  </div>


    <div wire:ignore.self class="modal modal-blur fade modal_customer_add" id="modal_add_new_customers"  data-bs-backdrop="static" datab-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">اضافة عميل</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="FormAddNewCustomers" method="POST" action="{{ route("sellers.create_customer") }}" >
                @csrf
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" class="form-control" name="name" placeholder="الاسم">
                    <span class="text-danger name_error"></span>
                   
                  </div>

                  <div class="mb-3">
                    <label class="form-label">البريد</label>
                    <input type="text" class="form-control" name="email" placeholder="البريد">
                    <span class="text-danger email_error"></span>

                  </div>

                  <div class="mb-3">
                    <label class="form-label">الهاتف</label>
                    <input type="number" class="form-control" name="phone" placeholder="رقم الهاتف">
                    <span class="text-danger phone_error"></span>

                  </div>

                  
             

                  <div class="mb-3">
                    <label class="form-label">المنطقة</label>
                    <input type="text" class="form-control" name="location" placeholder="المنطقة">
                    <span class="text-danger location_error"></span>
                  </div>
        
                  
        

                  <div class="mb-3">
                    <label class="form-label">المفضلة</label>
                    <input type="text"   class="form-control tags" id="fav" name="fav">
                    <span class="text-danger fav_error"></span>

                  </div>
        
                  <div class="mb-3">
                    <div class="form-label">الجنس</div>
                    <div>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="1" name="gender" checked="">
                        <span class="form-check-label">ذكر</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="0" name="gender">
                        <span class="form-check-label">انثي</span>
                      </label>
                   
                    </div>
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
