<div>
    <div class="container">
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
                    <h3 class="card-title">عمليات البيع</h3>
                    <p class="text-secondary"><span class="badge bg-info-lt">{{ $purchases->count() }} بيع</span></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                      <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-3 2.928m-5.5 3.5a8916.99 8916.99 0 0 0 -6.5 -6.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /><path d="M15 19l2 2l4 -4" /></svg>                </div>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">عمليات ناجحة</h3>
                    <p class="text-secondary"><span class="badge bg-success-lt">{{ $recoveryFalse }}</span></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                      <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mood-wrrr"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z" /><path d="M8 16l1 -1l1.5 1l1.5 -1l1.5 1l1.5 -1l1 1" /><path d="M8.5 11.5l1.5 -1.5l-1.5 -1.5" /><path d="M15.5 11.5l-1.5 -1.5l1.5 -1.5" /></svg>                </div>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">استرجاع</h3>
                    <p class="text-secondary"><span class="badge bg-danger-lt">{{ $recoveryTrue }}</span> </p>
                  </div>
                </div>
              </div>
    
              <div class="col-12 my-4">
                <h4>البحث من خلال التاريخ</h4>
                <div class="row my-4">
                    <div class="col-2">
                        <input type="submit" wire:click.prevent="allPurchases()" class="btn btn-success" value="جميع العمليات">
                    </div>
                    <div class="col-10">
                        <input type="date" wire:change="updateDATA()"  wire:model="date" class="form-control">
                    </div>
                    
                </div>
                <h2>العمليات</h2>
             
     
                @forelse ($purchases as $item)
                <div class="alert  alert-{{ $item->recovery == 1 ? "danger" : "success" }}" role="alert">
                    <div class="d-flex align-items-center justify-content-between ">
                      <div>
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                          </div>
                          <div>
                            <h4 class="alert-title">تم شراء {{ $item->book->name_book }} ({{ $item->cost }} جنية)</h4>
                            <h5>اسم العميل : {{ $item->customer->name }}</h5>
                            <div class="text-info"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-11"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l-2 -3" /><path d="M12 7v5" /></svg> {{ $item->created_at }} </div>
                          </div>
                      </div>
                      @if ($item->recovery != 0)
                      <button class="btn btn-outline-success btn-sm" wire:click.prevent="recoveryRemove({{ $item }})">حذف الاسترجاع</button>
                      @else 
                      <button class="btn btn-outline-danger btn-sm" wire:click.prevent="recoveryHandler({{ $item }})">استرجاع</button>
                      @endif
                    </div>
                  </div>
                @empty 
                <div class="alert alert-info">لا يوجد بيانات حالياً</div>
                @endforelse
                <div class="row mt-4">
                    {{ $purchases->links('livewire::simple-bootstrap') }}
                  </div> 
              </div>
        </div>
    </div>
</div>
