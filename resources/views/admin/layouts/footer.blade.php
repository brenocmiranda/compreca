<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('public/admin/js/jquery-ui.js') }}"></script>
<script src="{{ asset('public/admin/js/materialize.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Template JS File -->
<script src="{{ asset('public/admin/js/scripts.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.countdown.js') }}"></script>
<script src="{{ asset('public/admin/js/custom.js') }}"></script>
<script src="{{ asset('public/admin/js/stisla.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.mask.js') }}"></script>
<script src="{{ asset('public/admin/js/page/index.js') }}"></script>
<script src="{{ asset('public/admin/js/datatables.js') }}"></script>
<script src="{{ asset('public/admin/js/page/bootstrap-modal.js') }}"></script>
<script src="{{ asset('public/admin/js/page/modules-ion-icons.js') }}"></script>
<script src="{{ asset('public/admin/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('public/admin/modules/dropzonejs/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/admin/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('public/admin/modules/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('public/admin/modules/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ asset('public/admin/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('public/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('public/admin/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/admin/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('public/admin/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('public/admin/js/slick.js') }}"></script>

<script type="text/javascript">
  
    function dataPtBr(data){
      var aux = data.split('-');
      data = aux[2]+'/'+aux[1]+'/'+aux[0];
      return data;
    }

    // Carregamento experimentar da imagem
    function image(input){
      if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (oFREvent){
          $('#'+input.id).closest('#PreviewImage').attr('style', 'background: url('+oFREvent.target.result+') no-repeat; height:300px; background-size: contain; background-position: center;');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $(document).ready(function (){
      $(".colorpickerinput").colorpicker({
        format: 'hex',
        component: '.input-group-append',
      });

      $('select').formSelect();

      $('.logout').on('click', function() {
        swal({
          title: "Tem certeza que deseja sair?",
          icon: "warning",
          buttons: ["Cancelar", "Sair"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.document.location = "{{ route('logout') }}";
          } else {
            swal.close();
          }
        });
      });
    });
</script>

@yield('support')

</body>
</html>
