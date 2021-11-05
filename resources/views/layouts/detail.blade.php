<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="{{ asset('v1/production/images/favicon.png')}}" type="image/ico" />
   
   <title>Chuify Limited  </title>
  </head>

  <body>
  
        <!-- /top navigation -->
        @yield('content')
        <script> 
            $('.save').on('click', (event) => {
        event.preventDefault()
        swal({
            title: 'Confirm',
            text: 'Are you sure to assign this Order to this Rider',
            type: 'success',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $('.save').closest('form').submit();
            }
        });
        });

        

       </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.1.3/dist/sweetalert2.all.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
    
  </body>
</html>
