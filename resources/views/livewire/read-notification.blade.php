<div class="tab-content">
  <div class="tab-pane {{ $tab == 1 ? "active show" : "" }}" id="tabs-home-1" role="tabpanel">
    
    <h4>الاشعارات</h4>
    <div class="col-12">
      <input type="search" wire:model="search" wire:keydown="updateDATA()"  class="form-control my-4" placeholder="بحث : اسم الشخص" >
    </div>
    <div>

      @forelse ($notifications as $item)
      @php
        $data = json_decode($item->data, true);
        $Hours = Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->created_at)->diffInHours(Carbon\Carbon::now());
        $Days = Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->created_at)->diffInDays(Carbon\Carbon::now());
      @endphp
          <div class="alert alert-success" role="alert">
          <div class="d-flex justify-content-between">
            <div>
              <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
              </div>
              <div>
             
    
                <h4 class="alert-title">
                  @switch($data['type'])
                  @case('cash')
                    بوابة دفع || <span>{{ $data['name'] }}</span>
                    @break
                  @default
                        
                   @endswitch
                </h4>
                <div class="text-secondary">  تم دفع ملبغ 
                  {{ $data['price'] }} جنية
                   بواسطة بوابة دفع </div> [{{ $item->created_at }}]
                  @if ($Hours > 24)
                  [ منذ {{ $Days }} يوم]
                  @else 
                  [منذ {{ $Hours }} ساعات]
    
                  @endif
              </div>
            </div>
            <div>
              @if ($item->favorite == 1)
              <a href="#" wire:click.prevent="removeFavorite('{{ $item->id }}',1)" class="btn btn-success">
                <svg  xmlns="http://www.w3.org/2000/svg"   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                مفضل
              </a>
              @else 
              <a href="#" wire:click.prevent="addFavorite('{{ $item->id }}',1)" class="btn btn-outline-success">
                <svg  xmlns="http://www.w3.org/2000/svg"   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                مفضلة
              </a>
              @endif
          
            </div>
          </div>
           </div>
      @empty 
      <div class="alert alert-danger">البيانات غير متوفرة</div>
      @endforelse
      {{ $notifications->links('livewire::simple-bootstrap') }}

    </div>
  </div>
  <div class="tab-pane {{ $tab == 2 ? "active show" : "" }}" id="tabs-profile-1" role="tabpanel">
    <h4>المفضلة</h4>
    <div>
         @forelse ($notificationsUnFav as $item)
      @php
        $data = json_decode($item->data, true);
        $Hours = Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->created_at)->diffInHours(Carbon\Carbon::now());
        $Days = Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->created_at)->diffInDays(Carbon\Carbon::now());
      @endphp
      <div class="alert alert-success" role="alert">
        <div class="d-flex justify-content-between">
          <div>
            <div>
              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
            </div>
            <div>
           
  
              <h4 class="alert-title">
                @switch($data['type'])
                @case('cash')
                  بوابة دفع || <span>{{ $data['name'] }}</span>
                  @break
                @default
                      
                 @endswitch
              </h4>
              <div class="text-secondary">  تم دفع ملبغ 
                {{ $data['price'] }} جنية
                 بواسطة بوابة دفع </div> [{{ $item->created_at }}]
                @if ($Hours > 24)
                [ منذ {{ $Days }} يوم]
                @else 
                [منذ {{ $Hours }} ساعات]
  
                @endif
            </div>
          </div>
          <div>
            <a href="#" wire:click.prevent="removeFavorite('{{ $item->id }}',2)" class="btn btn-success">
              <svg  xmlns="http://www.w3.org/2000/svg"   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
              مفضل
            </a>
        
        
          </div>
        </div>
         </div>
         @empty
         <div class="alert alert-warning">لا يوجد بيانات فى المفضلة</div>

      @endforelse
      {{ $notificationsUnFav->links('livewire::simple-bootstrap') }}

    </div>
  </div>
  {{-- <div class="tab-pane" id="tabs-settings-1" role="tabpanel">
    <h4>Settings tab</h4>
    <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
  </div> --}}
</div>



  


