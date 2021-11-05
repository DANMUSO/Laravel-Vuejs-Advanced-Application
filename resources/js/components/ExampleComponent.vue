<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
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
            <tr>
            <td></td>
            <td><img src="" width="100%"/></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
            <a href="" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            <hr>
            <a href="" data-vendor_id="" class="btn btn-warning btn-xs deactivate-confirm"><i class="fa fa-ban"></i></a>       
            <br>
          
         </td>
            </tr>
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
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
