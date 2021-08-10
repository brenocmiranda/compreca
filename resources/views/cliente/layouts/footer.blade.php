<!--===============================================================================================-->
  <script src="{{ asset('public/cliente/vendor/jquery/jquery-3.2.1.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/animsition/js/animsition.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/bootstrap/js/popper.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/bootstrap/js/bootstrap.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/select2/select2.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/slick/slick.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/js/slick-custom.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/countdowntime/countdowntime.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/lightbox2/js/lightbox.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/vendor/sweetalert/sweetalert.min.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/js/jquery.mask.js') }}"></script>
  <script src="{{ asset('public/cliente/js/main.js').'?'.rand() }}"></script>
  <script src="{{ asset('public/cliente/js/jquery.complexify.js').'?'.rand() }}"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript">
    $(".selection-1").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect1')
    });

    $('.block2-btn-addcart').each(function(){
      var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
      $(this).on('click', function(){
        swal(nameProduct, "is added to cart !", "success");
      });
    });

    $('.block2-btn-addwishlist').each(function(){
      var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
      $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");
      });
    });
  </script>

  @yield('support')
  
</body>
</html>