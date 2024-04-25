<div>

    
    <div class="row my-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                    الخزانة  
                  </a>
                </li>
               
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
                  <h4>الخزانة</h4>
                  <div>
                    <div class="card">
                      <div class="card-stamp">
                        <div class="card-stamp-icon bg-yellow">
                          <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                        </div>
                      </div>
                      <div class="card-body">
                        <h3 class="card-title">
                            <span class="badge bg-pink-lt">في اليوم : {{ array_sum($purchases_this_day)  }}</span>
                            <span class="badge bg-info-lt">في  الاسبوع : {{ array_sum($purchases_this_week)  }}</span>
                            <span class="badge bg-success-lt">في  الشهر : {{ array_sum($purchases_this_month)  }}</span>
                            <span class="badge bg-warning-lt">في السنة : {{ array_sum($purchases_this_year)  }}</span>
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      
</div>
