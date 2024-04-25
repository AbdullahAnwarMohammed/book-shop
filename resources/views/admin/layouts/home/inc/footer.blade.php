<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-12">
          <span class="text-center">جميع حقوق النشر محفوظة @ِAbdullahAnwar</span>
        </div>
    
      </div>
    </div>
  </footer>
</div>
</div>

<!-- Libs JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/admin/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
<script src="/admin/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
<script src="/admin/dist/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
<script src="/admin/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>
<!-- Tabler Core -->
<script src="/admin/dist/js/demo.min.js?1692870487" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  
  $(function(){
    toastr.options = {
      'progressBar' : true, 
      'positionClass' : "toast-top-right"
    }
  })

  window.addEventListener("success",event=>{
    toastr.success(event.detail[0].message)
  })

  window.addEventListener("error",event=>{
    toastr.error(event.detail[0].message)
  })

</script>
@stack('js')
<script src="/admin/dist//js/tabler.min.js?1692870487" defer></script>

</body>
</html>