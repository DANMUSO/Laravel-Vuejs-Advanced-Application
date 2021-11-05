
              <div class="x_content" id="products">
              <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
              <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Active Products {{ $no}}</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Inactive Products {{ $no1}}</a>
              </li>
              </ul>
              <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="card-box table-responsive">
                   
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Product ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Status</th>
                    <th>Product Brand</th>
                    <th>Product Size</th>
                    <th>Product Type</th>
                    <th>Unit Price</th>
                    <th>Selling Price</th>
                    <th>Reorder Level</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($products as $product)
                  <tr id="product_id_{{ $product->product_id }}">
            
                    <td>{{ $product -> product_id}}</td>
                    <td><img src="{{ $product -> image}}" width="100%"/></td>
                    <td>{{ $product -> product_name}}</td>
                    <td>{{ $product -> refill_new}}</td>
                    <td>{{ $product -> product_brand}}</td>
                    <td>{{ $product -> product_size}}</td>
                    <td>{{ $product -> product_type}}</td>
                    <td>{{ $product -> unit_price}}</td>
                    <td>{{ $product -> selling_price}}</td>
                    <td>{{ $product -> reorder_level}}</td>
                    <td>{{ $product -> created_at}}</td>
                    <td> 
                    <a href="{{ route('administrator.products.edit', $product ->product_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                     <hr>
                     <a href="" data-product_id="{{ $product -> product_id }}" class="btn btn-warning btn-xs deactivate-product"><i class="fa fa-ban"></i> </a>
                    </td>
                  </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Status</th>
                    <th>Product Brand</th>
                    <th>Product Size</th>
                    <th>Product Type</th>
                    <th>Unit Price</th>
                    <th>Selling Price</th>
                    <th>Reorder Level</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                  </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="card-box table-responsive">
                   
                   <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                   <thead>
                   <tr>
                   <th>Product ID</th>
                   <th>Product Image</th>
                   <th>Product Name</th>
                   <th>Product Status</th>
                   <th>Product Brand</th>
                   <th>Product Size</th>
                   <th>Product Type</th>
                   <th>Unit Price</th>
                   <th>Selling Price</th>
                   <th>Reorder Level</th>
                   <th>Created at</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
                 @if(!empty($products_d) && $products_d->count())
                     @foreach($products_d as $product)
                 <tr id="product_id_{{ $product->product_id }}">
           
                   <td>{{ $product -> product_id}}</td>
                   <td><img src="{{ $product -> image}}" width="100%"/></td>
                   <td>{{ $product -> product_name}}</td>
                   <td>{{ $product -> refill_new}}</td>
                   <td>{{ $product -> product_brand}}</td>
                   <td>{{ $product -> product_size}}</td>
                   <td>{{ $product -> product_type}}</td>
                   <td>{{ $product -> unit_price}}</td>
                   <td>{{ $product -> selling_price}}</td>
                   <td>{{ $product -> reorder_level}}</td>
                   <td>{{ $product -> created_at}}</td>
                   <td> 
                   <a href="{{ route('administrator.products.edit', $product ->product_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <hr>
                    <a href="" data-product_id="{{ $product -> product_id }}" class="btn btn-warning btn-xs activate-product"><i class="fa fa-ban"></i> </a>
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
                   <th>Product ID</th>
                   <th>Product Image</th>
                   <th>Product Name</th>
                   <th>Product Status</th>
                   <th>Product Brand</th>
                   <th>Product Size</th>
                   <th>Product Type</th>
                   <th>Unit Price</th>
                   <th>Selling Price</th>
                   <th>Reorder Level</th>
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

</script>