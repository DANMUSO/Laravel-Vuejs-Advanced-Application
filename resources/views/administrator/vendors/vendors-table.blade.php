<div class="x_content" id="products">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Active Vendors  <b style="color:green">{{ $no }}</b></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Inactive Vendors  <b style="color:green">{{ $no1 }}</b></a>
            </li>
            </ul>
            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card-box table-responsive">
                              
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
            <th>Vendor ID</th>
            <th>Vendor Photo</th>
            <th>Vendor's Name</th>
            <th>Physical Address</th>
            <th>Contact Person</th>
            <th>Contact person Phone</th>
            <th>Contact person Email</th>
            <th>Contract Document</th>
            <th>Created at</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vendors as $vendor)
            <tr>
            <td>{{ $vendor -> vendor_id}}</td>
            <td><img src="{{ $vendor -> image}}" width="100%"/></td>
            <td>{{ $vendor -> vendor_name}}</td>
            <td>{{ $vendor -> vendor_address}}</td>
            <td>{{ $vendor -> person}}</td>
            <td>{{ $vendor -> phone}}</td>
            <td>{{ $vendor -> email}}</td>
            <td>
            <a href="{{ $vendor -> doc}}" download class="fa fa-eye" target="_blank">
            DOWNLOAD
             </a>
            </td>
            <td>{{ $vendor -> created_at}}</td>
            <td>
            <a href="{{ route('administrator.vendors.edit', $vendor ->vendor_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            <hr>
            <a href="" data-vendor_id="{{ $vendor -> vendor_id }}" class="btn btn-warning btn-xs deactivate-confirm"><i class="fa fa-ban"></i></a>       
            <br>
          
         </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
            <th>Vendor ID</th>
            <th>Vendor Photo</th>
            <th>Vendor's Name</th>
            <th>Physical Address</th>
            <th>Contact Person</th>
            <th>Contact person Phone</th>
            <th>Contact person Email</th>
            <th>Contract Document</th>
            <th>Created at</th>
            <th>Action</th>
            </tr>
            </tfoot>
            </table>
            </div>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<div class="card-box table-responsive">
                   
            <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
            <th>Vendor ID</th>
            <th>Vendor Photo</th>
            <th>Vendor's Name</th>
            <th>Physical Address</th>
            <th>Contact Person</th>
            <th>Contact person Phone</th>
            <th>Contact person Email</th>
            <th>Contract Document</th>
            <th>Created at</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($vendors_d) && $vendors_d->count())
            @foreach($vendors_d as $vendor)
            <tr>
            <td>{{ $vendor -> vendor_id}}</td>
            <td><img src="{{ $vendor -> image}}" width="100%"/></td>
            <td>{{ $vendor -> vendor_name}}</td>
            <td>{{ $vendor -> vendor_address}}</td>
            <td>{{ $vendor -> person}}</td>
            <td>{{ $vendor -> phone}}</td>
            <td>{{ $vendor -> email}}</td>
            <td>
            <a href="{{ $vendor -> doc}}" download class="fa fa-eye" target="_blank">
            DOWNLOAD
             </a>
            </td>
            <td>{{ $vendor -> created_at}}</td>
            <td>
            <a href="{{ route('administrator.vendors.edit', $vendor ->vendor_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            <hr>
            <a href="" data-vendor_id="{{ $vendor -> vendor_id }}" class="btn btn-warning btn-xs activate-confirm"><i class="fa fa-ban"></i></a>       
            <br>
          
         </td>
            </tr>
            @endforeach
            @else
                           <tr>
                            <td colspan="25">
                            <div class="card" style="width: 100%;">
                            <div class="card-header">
                        <i style="margin-left:40%;">There are no data</i>
                            </div>
                            </div>
                            </td>
                           </tr> 
                            @endif
            </tbody>
            <tfoot>
            <tr>
            <th>Vendor ID</th>
            <th>Vendor Photo</th>
            <th>Vendor's Name</th>
            <th>Physical Address</th>
            <th>Contact Person</th>
            <th>Contact person Phone</th>
            <th>Contact person Email</th>
            <th>Contract Document</th>
            <th>Created at</th>
            <th>Action</th>
            </tr>
            </tfoot>
            </table>
            </div>
            </div>
            </div>
            </div>

<script type='text/javascript'>
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
</script>
