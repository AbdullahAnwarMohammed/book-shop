<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              
              <h2 class="page-title">
                <span class="d-block m-2">الكتب</span> <span class="badge bg-success-lt">{{ $counts }}</span>
              </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                @if (Auth::guard("admin")->check())
                <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="Good" data-bs-toggle="modal" data-bs-target="#modal_add_new_book">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                  اضافة كتاب جديد
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
            <div class="col-6">
              <input type="search" wire:model="search" wire:keydown="handlerSearch()" class="form-control" placeholder="مثال : رويات">
            </div>
            <div class="col-6">
              <select wire:model="category" wire:change="handlerSearch()" class="form-control">
                <option value="">اختر القسم</option>
                @foreach (\App\Models\Category::whereHas('books')->get() as $Item)
                  <option value="{{ $Item->id }}">{{ $Item->name }}</option>
                @endforeach
              </select>
            </div>
            @forelse ($Books as $Item)
                 
            <div class="col-md-6 col-lg-3">
              <div class="card">
                <div class="card-body p-4 text-center">
                  <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ asset('admin/uploads/books/'.$Item->featured_image) }})"></span>
                  <h3 class="m-0 mb-1"><a href="#">{{ Str::substr($Item->name_book , 0, 25)."..." }}</a></h3>
                 @if ($Item->quantity < 10)
                    @php
                    $book = "كتب"
                      @endphp
                    @elseif($Item->quantity > 10)
                      @php
                        $book = "كتاب"
                      @endphp

                 @endif
                  
                  <h2> <span class="badge bg-{{ $Item->quantity > 0 ? "success" : "danger" }}-lt">{{ $Item->quantity }} {{ $Item->quantity > 0 ? $book : ""}} </span> </h2>
                  <div class="mt-3">
                    
                    <span class="badge bg-info-lt ">{{ $Item->category->name }}</span>
                    <span class="badge bg-warning-lt" @if ($Item->tax !== NULL) style="text-decoration: line-through" @endif >{{ $Item->price }} جنية</span>
                    @if ($Item->tax !== NULL)
                    <span class="badge bg-success-lt">{{  $Item->price *  $Item->tax / 100 }} جنية</span>
                    @endif
                  </div>
                </div>
                @if (Auth::guard('admin')->check())
                    <div class="d-flex">
                    <a href="#"  wire:click.prevent="editBook({{ $Item }})"  class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M11.35 17.39l-4.35 2.61v-14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v6"></path><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path></svg>تعديل</a>
                 
                    <a href="#" wire:click.prevent="deleteBook({{ $Item }})" class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    حذف</a>
                  </div>
                @endif
                @if (Auth::guard('web')->check())
                <div class="d-flex">
                  <a href="#"  wire:click.prevent="SellBook({{ $Item }})"  class="card-btn bg-info"><!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" /></svg>
                     بيع
                </a>
               
                  <a href="#" wire:click.prevent="addToCart({{ $Item }})" class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                     السلة 
                </a>
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
        </div>
      </div>

      <!-- modal add new book modal_add_new_book -->
      <div wire:ignore.self class="modal modal-blur fade modal_books" id="modal_add_new_book"  data-bs-backdrop="static" datab-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">اضافة كتاب جديد</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="form_add_new_category" method="POST" action="{{ route("admin.create_book") }}" enctype="multipart/form-data">
                @csrf  
                <div class="mb-3">
                    <label class="form-label">اسم الكتاب</label>
                    <input type="text" class="form-control" name="name_book" placeholder="اسم الكتاب">
                    <span class="text-danger name_book_error"></span>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">اسم المؤلف</label>
                    <input type="text" class="form-control" name="name_author" placeholder="اسم المؤلف">
                    <span class="text-danger name_author_error"></span>

                  </div>

                  <div class="mb-3">
                    <label class="form-label">الكمية</label>
                    <input type="number" class="form-control" name="quantity" placeholder="الكمية">
                    <span class="text-danger quantity_error"></span>

                  </div>

                  <div class="mb-3">
                    <label class="form-label">السعر</label>
                    <input type="number" class="form-control" name="price" placeholder="السعر">
                    <span class="text-danger price_error"></span>

                  </div>

                  <div class="mb-3">
                    <label class="form-label">الخصم</label>
                    <input type="number" class="form-control" name="tax" placeholder="الخصم">
                    <span class="text-danger tax_error"></span>

                  </div>
                  <div class="mb-3">
                    <label class="form-label">الصورة</label>
                    <input type="file" class="form-control" name="featured_image" placeholder="الصورة">
                    <span class="text-danger featured_image_error"></span>

                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">القسم</label>
                    <select name="category_id" class="form-control">
                      @foreach (\App\Models\Category::where('active','1')->get() as $Item)
                          <option value="{{ $Item->id }}">{{ $Item->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger featured_image_error"></span>

                  </div>
                  
                  

                  <div class="mb-3">
                    <label class="form-label">وصف</label>
                    <textarea name="descrption" class="form-control" id="" cols="10" rows="2"></textarea>
                    <span class="text-danger descrption_error"></span>

                  </div>


                  
                  <div class="mb-3">
                    <label class="form-label">عدد الصفحات</label>
                    <input type="number" class="form-control" name="number_of_pages_error">
                    <span class="text-danger number_of_pages_error"></span>

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


      <!-- modal update book modal_add_new_book -->
      <div wire:ignore.self class="modal modal-blur fade" id="modal_update_book"  data-bs-backdrop="static" datab-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">اضافة كتاب جديد</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="form_update_book" method="POST" wire:submit.prevent="UpdateBook()" enctype="multipart/form-data">
              <div class="mb-3">
                  <label class="form-label">اسم الكتاب</label>
                  <input type="text" class="form-control" wire:model="name_book" placeholder="اسم الكتاب">
                  <span class="text-danger name_book_error"></span>
                </div>

                <div class="mb-3">
                  <label class="form-label">اسم المؤلف</label>
                  <input type="text" class="form-control" wire:model="name_author" placeholder="اسم المؤلف">
                  <span class="text-danger name_author_error"></span>

                </div>

                <div class="mb-3">
                  <label class="form-label">الكمية</label>
                  <input type="number" class="form-control" wire:model="quantity" placeholder="الكمية">
                  <span class="text-danger quantity_error"></span>

                </div>

                <div class="mb-3">
                  <label class="form-label">السعر</label>
                  <input type="number" class="form-control" wire:model="price" placeholder="السعر">
                  <span class="text-danger price_error"></span>

                </div>

                <div class="mb-3">
                  <label class="form-label">الخصم</label>
                  <input type="number" class="form-control" wire:model="tax" placeholder="الخصم">
                  <span class="text-danger tax_error"></span>

                </div>
                <div class="mb-3">
                  <label class="form-label">الصورة</label>
                  <input type="file" class="form-control" wire:model="featured_image" placeholder="الصورة">
                  <span class="text-danger featured_image_error"></span>

                </div>
                
                <div class="mb-3">
                  <label class="form-label">القسم</label>
                  <select wire:model="category_id" class="form-control">
                    
                    @foreach (\App\Models\Category::where('active','1')->get() as $Item)
                        <option value="{{ $Item->id }}" >{{ $Item->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger featured_image_error"></span>

                </div>
                
                

                <div class="mb-3">
                  <label class="form-label">وصف</label>
                  <textarea wire:model="descrption" class="form-control" id="" cols="10" rows="2"></textarea>
                  <span class="text-danger descrption_error"></span>

                </div>


                
                <div class="mb-3">
                  <label class="form-label">عدد الصفحات</label>
                  <input type="number" class="form-control" wire:model="number_of_pages_error">
                  <span class="text-danger number_of_pages_error"></span>

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


        <!-- modal update book modal_add_new_book -->
        <div wire:ignore.self class="modal modal-blur fade" id="modal_sell_book"  data-bs-backdrop="static" datab-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"> {{ $name_book }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form wire:submit.prevent="HandlerSellBook()">
                  <div class="mb-3">
                    <label class="form-label">اختر وسيلة الدفع</label>
                    <div class="form-selectgroup">
                      <label class="form-selectgroup-item">
                        <input type="radio"  wire:model="type_pay" req value="manual" class="form-selectgroup-input" checked="">
                        <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-coins"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" /><path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" /><path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" /><path d="M3 6v10c0 .888 .772 1.45 2 2" /><path d="M3 11c0 .888 .772 1.45 2 2" /></svg>
                          يدوي  
                        </span>
                      </label>
                      <label class="form-selectgroup-item">
                        <input type="radio"  wire:model="type_pay" value="cash" class="form-selectgroup-input">
                        <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                          كاش</span>
                      </label>

                     
                    
                    </div>
                    @error('type_pay')
                  <span class="d-block text-danger">{{ $message }}</span>
                  @enderror
                  </div>

                

                  <div class="mb-3">
                    <div class="row">
                      <div class="col-10">
                        <label for="">العميل</label>
                        <input type="text" class="form-control" wire:model="customer" placeholder="الرمز التعريفي للعميل">
                        
                        @error('customer')
                          <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-2">
                        <label for="">السعر</label>
                        <input type="text" class="form-control" wire:model="price_book" value="{{ $price_book }}" disabled>

                      </div>
                    </div>
                 
                  </div>
               
                  <div class="modal-footer">
                    <button type="button" class="btn me-auto btn-danger" data-bs-dismiss="modal">
                      قفل
                    </button>
                    <button type="submit" class="btn btn-success" >شراء</button>
                  </div>

                </form>
               
              </div>
              
            </div>
          </div>
          </div>




</div>

