<div>
    <div class="container my-4">
        @if (count($Carts) > 0)

        <div class="row my-4">
            <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                      <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">عدد الطلبات</h3>
                    <p class="text-secondary"><span class="badge bg-info-lt">{{ count($Carts) }} طلبات</span></p>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                      <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">التكلفة</h3>
                    <p class="text-secondary"><span class="badge bg-info-lt">{{ $cost }} جنية</span></p>
                  </div>
                </div>
              </div>


        </div>  
        <div class="row my-4">
            @error('hash')
            <span class="alert alert-danger">{{ $message }}</span>
        @enderror
            <h2>
                العربة <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
               
            </h2>
            <div class="col-12 my-2">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <select class="form-select" wire:model="type_payment">
                              <option value="manually">يدوي</option>
                              <option value="cash">كاش</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" wire:model="hash" placeholder="رمز العميل" required> 
                      
                    </div>
                    <div class="col">
                        <button class="btn btn-success" wire:click.prevent="HandlerSell()">تاكيد الطلب</button>
                    </div>
                </div>

            </div>
            @endif
            @forelse ($Carts as $Item)
          

            <div class="col-lg-4">
                <div class="card">
                  <div class="row row-0">
                    <div class="col-3 order-md-last">
                      <!-- Photo -->
                      <img src="/admin/uploads/books/{{ $Item->book->featured_image }}"
                       class="w-100 h-100 object-cover card-img-start" alt="Beautiful blonde woman relaxing with a can of coke on a tree stump by the beach">
                    </div>
                    <div class="col">
                      <div class="card-body">
                        <h3 class="card-title">
                            {{ $Item->book->name_book }}

                        </h3>
                        <div>
                            <span class="badge bg-success-lt">{{ $Item->cost }} جنية</span>
                            <span class="badge bg-info-lt">{{ $Item->book->category->name }}</span>

                        </div>
                        <p class="text-secondary">
                        
                        </p>
                         </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <button class="btn  btn-outline-danger btn-md" wire:click="removeCart({{ $Item }})">الغاء الطلب</button>
                        <button class="btn  btn-outline-success btn-md" wire:click="buyOneBook({{ $Item }})">شراء</button>
                    </div>
                  </div>

                </div>
              </div>

           

          
            @empty
            <div class="card card-md">
                <div class="card-stamp card-stamp-lg">
                  <div class="card-stamp-icon bg-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-sad-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M14.5 16.05a3.5 3.5 0 0 0 -5 0" /><path d="M10 9.25c-.5 1 -2.5 1 -3 0" /><path d="M17 9.25c-.5 1 -2.5 1 -3 0" /></svg>                  </div>
                </div>
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-10">
                      <h3 class="h1">لا توجد بيانات</h3>
                      <div class="markdown text-secondary">
                        عليك اضافة منتج ليظهر لك فى تلك الصفحة
                      </div>
                      <div class="mt-3">
                        <a href="{{ route("sellers.books") }}" class="btn btn-info"  rel="noopener"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-books"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M5 8h4" /><path d="M9 16h4" /><path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" /><path d="M14 9l4 -1" /><path d="M16 16l3.923 -.98" /></svg> كتب</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforelse

           
        </div>
    </div>
   
</div>
