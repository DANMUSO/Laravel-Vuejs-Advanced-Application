<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ asset('v1/production/images/favicon.png')}}" type="image/ico" />

  <link rel="stylesheet" href="//www.codermen.com/css/bootstrap.min.css">  
  <script src=//www.codermen.com/js/jquery.js></script>
    <title>Chuify Limited  </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('v1/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('v1/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('v1/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('v1/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Custom built theme - This already includes Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('vendor/mckenziearts/laravel-notify/css/app.css') }}">
    @notifyCss
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link href="{{ asset('v1/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('v1/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('v1/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('v1/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('v1/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('v1/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('v1/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('v1/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('v1/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('v1/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('v1/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('v1/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{ asset('v1/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{ asset('v1/build/css/custom.min.css')}}" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
    <style type="text/css">
        #map {
            width: 100%;
            height: 400px;
        },
        .get-number {
  padding: 0.5em 1em;
  background-color: lightblue;
  border-radius: 0.2em;
  display: inline-block;
  margin: 1em 0;
  cursor: pointer;
}
    </style>
<script src="https://raw.githack.com/jackocnr/intl-tel-input/41735773e78c39aad6aaee53a6126215f64aeb57/build/js/intlTelInput.js"></script>
<link href="https://raw.githack.com/jackocnr/intl-tel-input/master/build/css/intlTelInput.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script>
<script  src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>

<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>

<!-- firebase integration end -->

<!-- Comment out (or don't include) services that you don't want to use -->
<!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->

<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>
  
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-paw"></i> <span> Xoom Gas</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('v1/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
               
                <ul class="nav side-menu" >
                  <li><a href="{{url('/administrator')}}" style="color:white;"><i class="fa fa-home"></i> Dashboard</a>
                   
                  </li>
                  <li><a style="color:white;"><i class="fa fa-align-justify"></i>Inventory Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="{{ route('administrator.vendors.index')}}" style="color:white;">Vendors</a></li>
                      <li><a href="{{ route('administrator.products.index')}}" style="color:white;">Products</a></li>
                      <li><a href="{{ route('administrator.purchaseorders.index')}}" style="color:white;">Purchase Orders</a></li>
                    
                    </ul>
                  </li>
                 <li><a><i class="fa fa-motorcycle"></i>Riders Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('administrator.riders.index')}}">Riders</a></li>
                      <li><a href="{{ route('administrator.assignedorders.index')}}">Assigned orders</a></li>
                      <li><a href="{{ route('administrator.trips.index')}}">Trips</a></li>
                      <li><a href="{{ route('administrator.ridermap.index')}}">Current Location</a></li>
                    </ul>
                  </li>
                 <li><a><i class="fa fa-user"></i>Clients Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('administrator.users.index')}}">Users</a></li>
                      <li><a href="{{ route('administrator.usermap.index')}}">Users Location</a></li>
                     </ul>
                  </li> 
                 <li><a><i class="fa fa-shopping-cart"></i> Orders Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('administrator.order.index')}}">Orders</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-usd"></i> Payment Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('administrator.payments.index')}}">Payments</a></li>
                     
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                
                <ul class="nav side-menu">
                </ul>
              </div>

            </div>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu" style="background-color:#C71585">
              <div class="nav toggle" style="color:white;">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav" >
              <ul class=" navbar-right">
              <li class="nav-item">
          <a class="nav-link d" href="{{ route('administrator.logout') }}" style="color:white"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="nav-icon fa fa-sign-out-alt text-danger"></i>
                                       {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('administrator.logout') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
 
                   </li> 
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        @yield('content')
  
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right" style="color:#000">
          <strong>Copyright &copy; 2021 <a href="#">Xoom-Gas</a>.</strong>
    All rights reserved.
             </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
      <script>
    Echo.channel('events')
        .listen('RealTimeMessage', (e) => console.log('Private RealTimeMessage: ' + e.message));
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('v1/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('v1/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('v1/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('v1/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('v1/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('v1/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('v1/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('v1/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ asset('v1/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ asset('v1/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('v1/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('v1/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('v1/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('v1/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('v1/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('v1/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ asset('v1/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('v1/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('v1/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('v1/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('v1/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- jQuery -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('v1/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
   <script src="{{ asset('v1/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('v1/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('v1/vendors/nprogress/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('v1/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{ asset('v1/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset('v1/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('v1/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{ asset('v1/build/js/custom.min.js')}}"></script>
	 
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

$('.deactivate-confirm').on('click', function (event) {
    event.preventDefault();
    var vendor_id = $(this).data('vendor_id');
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "You want to deactivate vendor Id!  "+vendor_id+"?",
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
      if (value) {
         swal(

      'Deactivated Successfully!',
      '',
      'success'
        )
      $.ajax({
        url : '{{ url("vendordeactivate") }}',
        type: 'PUT',
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data:{vendor_id:vendor_id},
        success:function(data){
          $("#vendor_id_" + vendor_id).remove();
          $('#table_data').html(data);
      },
    });
  }
    });
});

$('.activate-confirm').on('click', function (event) {
    event.preventDefault();
    var vendor_id = $(this).data('vendor_id');
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "You want to activate vendor Id!  "+vendor_id+"?",
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
      if (value) {
         swal(

      'Activated Successfully!',
      '',
      'success'
        )
      $.ajax({
        url : '{{ url("vendoractivate") }}',
        type: 'PUT',
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data:{vendor_id:vendor_id},
        success:function(data){
          $("#vendor_id_" + vendor_id).remove();
          $('#table_data').html(data);
      },
    });
  }
    });
});


$('.deactivate-product').on('click', function (event) {
    event.preventDefault();
    var product_id = $(this).data('product_id');
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "You want to deactivate product Id!  "+product_id+"?",
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
      if (value) {
         swal(

      'Deactivated Successfully!',
      '',
      'success'
        )
      $.ajax({
        url : '{{ url("productdeactivate") }}',
        type: 'POST',
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data:{product_id:product_id},
        success:function(data){
          console.log(data);
          $("#product_id_" + product_id).remove();
          $('#table_data').html(data);
      },
    });
  }
    });
});

$('.activate-product').on('click', function (event) {
    event.preventDefault();
    var product_id = $(this).data('product_id');
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "You want to activate product Id!  "+product_id+"?",
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
      if (value) {
         swal(

      'Activated Successfully!',
      '',
      'success'
        )
      $.ajax({
        url : '{{ url("productactivate") }}',
        type: 'PUT',
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data:{product_id:product_id},
        success:function(data){
          $("#product_id_" + product_id).remove();
          $('#table_data').html(data);
      },
    });
  }
    });
});


$("#ImageMedias").change(function () {
	if (typeof (FileReader) != "undefined") {
		var dvPreview = $("#divImageMediaPreview");
		dvPreview.html("");            
		$($(this)[0].files).each(function () {
			var file = $(this);                
				var reader = new FileReader();
				reader.onload = function (e) {
					var img = $("<img />");
					img.attr("style", "width: 150px; height:100px; padding: 10px");
					img.attr("src", e.target.result);
					dvPreview.append(img);
				}
				reader.readAsDataURL(file[0]);                
		});
	} else {
		alert("This browser does not support HTML5 FileReader.");
	}
});
$(function(){
            $('#value1, #value2,#value3').keyup(function(){
               var value1 = parseFloat($('#value1').val()) || 0;
               var value2 = parseFloat($('#value2').val()) || 0;
              var value3 = parseFloat($('#value3').val()) || 0;
   $('#sum').val(value1 * value2 + (value1 * value2)*value3/100);
            });
         });
        
    $('#vendor, #product_size').bind('keypress blur', function() {
        
        $('#product_name').val($('#vendor').val() + ' ' +
                              $('#product_size').val() );
    });
    
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
  
</script>
<script>
</script>

                     <script>
                     $(document).ready(function (){
                     $('.servideletebtn').click(function(e){
                       e.preventDefault();
                       alert('Hello');
                     }); 
                     });
                     </script>

                    <script>
                    var coll = document.getElementsByClassName("collapsible");
                    var i;
                    for (i = 0; i < coll.length; i++) {
                      coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.maxHeight){
                          content.style.maxHeight = null;
                        } else {
                          content.style.maxHeight = content.scrollHeight + "px";
                        } 
                      });
                    }
                  </script>
              

                <script>
                function showDtails(order_id){
                    $.ajax({
                                url : '{{ route("order") }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{order_id:order_id},
                                success:function(data){
                                    $('.modal-body').html(data)
                                },
                            });
                }
                </script>
                
                <script>
                function completeOrder(order_id){
                    $.ajax({
                                url : '{{ route("completeOrder") }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{order_id:order_id},
                                success:function(data){
                                    $('#exampleModal').modal('hide');
                                    $('.modal-body').html(data)
                                },
                            });
                }
                </script>
                  <script>
                function showConfirm(order_id){
                    $.ajax({
                                url : '{{ route("confirm") }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{order_id:order_id},
                                success:function(data){
                                    $('.modal-body').html(data)
                                },
                            });
                }
                </script>
                  <script>
                function showTransit(order_id){
                    $.ajax({
                                url : '{{ route("transit") }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{order_id:order_id},
                                success:function(data){
                                    $('.modal-body').html(data)
                                },
                            });
                }
                </script>
                  <script>
                function showDelivered(order_id){
                    $.ajax({
                                url : '{{ route("delivered") }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{order_id:order_id},
                                success:function(data){
                                    $('.modal-body').html(data)
                                },
                            });
                }
                </script>
                <script>
                function showCancelled(order_id){
                    $.ajax({
                                url : '{{ route("cancelled") }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{order_id:order_id},
                                success:function(data){
                                    $('.modal-body').html(data)
                                },
                            });
                }
                </script>
                <script>
               $(document).ready(function() {
                $('#example').DataTable( {
                  destroy: true,
                  searching: true,
                  paging: true,
                  retrieve: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]
                  } );
                } );
                </script>
               <script type="text/javascript">
                  $(document).ready(function() {
                    $('.submit').DataTable( {
                      destroy: true,
                      searching: true,
                      paging: true,
                      retrieve: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    } );
                } );
              </script>
                @include('sweetalert::alert')
                <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="/__/firebase/8.1.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="/__/firebase/8.1.1/firebase-analytics.js"></script>

<script src="{{ asset('vendor/mckenziearts/laravel-notify/js/app.js') }}"></script>
    @include('notify::messages')
    @notifyJs
<!-- Initialize Firebase -->
<script src="/__/firebase/init.js"></script>
<scrip src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Mdfwtdyn_3vtVSAhXPuAEnaJm6ff0mw&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <script>

    var has.errors = {{ $errors->count() > 0 ? 'true' : 'false' }};

    if (has.errors)
    {
      Swal.fire({
        title: 'Errors',
        icon: 'error',
        html: jQuery("#vendor_error").html(),
        showCloseButton: true,
      });
    }
    
    </script>
  </body>
  <script type="text/javascript">
        // Your web app's Firebase configuration
        const firebaseConfig = {
          apiKey: "AIzaSyC_uSpCoQDfgAqkb_qlA5wYDeie-qdvmu8",
          authDomain: "xoomnotifications.firebaseapp.com",
          databaseURL: "https://xoomnotifications.firebaseio.com",
          projectId: "xoomnotifications",
          storageBucket: "xoomnotifications.appspot.com",
          messagingSenderId: "605878760943",
          appId: "1:605878760943:web:c1a5d98e843da50ecbf21a",
          measurementId: "G-LKPHZMFCNT"
        };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      //firebase.analytics();
      const messaging = firebase.messaging();
        messaging
      .requestPermission()
      .then(function () {
      //MsgElem.innerHTML = "Notification permission granted." 
        console.log("Notification permission granted.");
          // get the token in the form of promise
        return messaging.getToken()
      })
      .then(function(token) {
      // print the token on the HTML page 
      //alert(token);    
        console.log(token);
        $.ajax({
          url: '{{ route("token") }}',
          type: "POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          
          data:{ token: token},
          dataType: "text",
          //success: function(resultData) { alert("Save Complete");}
        });
        
      })
      .catch(function (err) {
        console.log("Unable to get permission to notify.", err);
      });
      messaging.onMessage(function(payload) {
          console.log(payload);
          var notify;
          notify = new Notification(payload.notification.title,{
              body: payload.notification.body,
              icon: payload.notification.icon,
              tag: "Xoom_Gas"
          });
          console.log(payload.notification);
      });
          //firebase.initializeApp(config);
      var database = firebase.database().ref().child("/users/");
        
      database.on('value', function(snapshot) {
          renderUI(snapshot.val());
      });
      // On child added to db
      database.on('child_added', function(data) {
        console.log("Comming");
          if(Notification.permission!=='default'){
              var notify;
              
              notify= new Notification('Xoomgas - '+data.val().username,{
                  'body': data.val().message,
                  'icon': 'bell.png',
                  'tag': data.getKey()
              });
              notify.onclick = function(){
                  alert(this.tag);
              }
          }else{
              alert('Please allow the notification first');
          }
      });
      self.addEventListener('notificationclick', function(event) {       
          event.notification.close();
      });
  </script>
             
<script type=text/javascript>
  $('#product_brand').change(function(){
  var vendorID = $(this).val();  
  if(vendorID){
    $.ajax({
      type:"GET",
      url:"{{url('product')}}?vendor_id="+vendorID,
      success: data => {
                     $("#product_name").empty();
                data.products.forEach(product_name =>
                    $('#product_name').append(`<option value="${product_name.product_id}">${product_name.product_name}, ${product_name.refill_new}</option>`)
                )
            }});
  }else{
    $("#product_name").empty();
  
  }   
  });
  var input = document.querySelector("#telephone");
let iti = window.intlTelInput(input, {
  // options here
  allowDropdown: true,
  autoHideDialCode: true,
  autoPlaceholder: "polite",
  separateDialCode: true,
  customPlaceholder: true,
  preferredCountries: ['KE', 'UG', 'TZ','RW','ET','SO'],
  utilsScript: "https://raw.githack.com/jackocnr/intl-tel-input/master/build/js/utils.js"

});

$(".get-number").on("click", function() {
  console.log(iti.getNumber());
});
</script> <!-- 
<script src="/js/app.js"></script> -->
</html>