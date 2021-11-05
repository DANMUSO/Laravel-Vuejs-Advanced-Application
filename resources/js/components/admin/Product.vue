<template>
    <div class="container">
        <br><br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Products</h5>

                 <div class="card-tools">
                      <button class="btn btn-success" @click="newModal">
                      Add Product  <i class="fas fa-plus"></i>
                      </button>
                      
        <!-- Modal -->
       
      <div class="modal fade" id="newModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-show="!editmode">Add Product</h4>
              <h4 class="modal-title" v-show="editmode">Update Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editmode ? updateProduct() : addProduct()">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Product Status</label>
                        <select class="form-control" name="refill_new" v-model="form.refill_new">
                          <option>Refill</option>
                          <option>New (Gas + Cylinder)</option>
                          <option>New Accessory</option>
                        </select>
                        <div v-if="form.errors.has('refill_new')" style="color:red;" v-html="form.errors.get('refill_new')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Vendor's Name</label>
                        <select class="form-control" name="vendor_id" v-model="form.vendor_id">
                          <option v-for="vendor in vendors" :key="vendor.id" v-bind:value="vendor.vendor_id">{{vendor.vendor_name}}</option>
                        </select>
                       <div v-if="form.errors.has('vendor_id')" style="color:red;" v-html="form.errors.get('vendor_id')" />
                        </div>
                    
                    <div class="form-group col-md-6">
                        <label>Product Brand</label>
                        <input type="text" class="form-control"  id="product_brand" name="product_brand" v-model="form.product_brand" placeholder="Product Brand">
                        <div v-if="form.errors.has('product_brand')" style="color:red;" v-html="form.errors.get('product_brand')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Product Size</label>
                        <select type="text" class="form-control" id="product_size" name="product_size" v-model="form.product_size">
                            <option>6 KGS</option>
                            <option>13 KGS</option>
                            <option>50 KGS</option>
                        </select>
                        <div v-if="form.errors.has('product_size')" style="color:red;" v-html="form.errors.get('product_size')" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Product Name</label>
                        <input type="text" id="product_name" v-show="!editmode" disabled="false" class="form-control" name="product_name" placeholder="Product Name">
                        <input type="text" id="product_name" v-show="editmode" disabled="false" v-model="form.product_name" class="form-control" name="product_name" placeholder="Product Name">
                        <div v-if="form.errors.has('product_name')" style="color:red;" v-html="form.errors.get('product_name')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Product Type</label>
                        <select type="text" class="form-control" name="product_type" v-model="form.product_type">
                          <option>Gas Cylinder</option>
                          <option>Accessory</option>
                        </select>
                        <div v-if="form.errors.has('product_type')" style="color:red;" v-html="form.errors.get('product_type')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Unit Price</label>
                        <input type="text" class="form-control" name="unit_price" v-model="form.unit_price" placeholder="Unit Price">
                        <div v-if="form.errors.has('unit_price')" style="color:red;" v-html="form.errors.get('unit_price')" />
                    </div>
                     <div class="form-group col-md-6">
                        <label for="">Selling Price</label>
                        <input type="text" class="form-control" name="selling_price" v-model="form.selling_price" placeholder="Selling Price">
                        <div v-if="form.errors.has('selling_price')" style="color:red;" v-html="form.errors.get('selling_price')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Reorder Level</label>
                        <input type="text" class="form-control" name="reorder_level" v-model="form.reorder_level" placeholder="Reorder Level">
                        <div v-if="form.errors.has('reorder_level')" style="color:red;" v-html="form.errors.get('reorder_level')" />
                    </div>
            
                        <div class="form-group col-md-6">
                        <label for="inputCity">Attach Photo</label>
                        <input type="file" @change="productImage" class="form-control" id="ImageMedias" name="image">
                        <div v-if="form.errors.has('photo')" v-html="form.errors.get('photo')" style="color:red;"/>
                        <div id="divImageMediaPreview"></div>
                        </div>
                         </div>
                         
                         <button type="submit" v-show="editmode" class="btn btn-success">Update</button>
                         <button type="submit" v-show="!editmode"  class="btn btn-primary">Save</button>
                   
                    </form>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
      </div>
      <!-- /.modal-dialog -->
      
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                 
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
                     <tr v-for="product in products" :key="product.id">
                      <td>{{ product.product_id}}</td>
                      <td><img v-bind:src="product.image" width="100%"/></td>
                      <td>{{ product.product_name}}</td>
                      <td>{{ product.refill_new}}</td>
                      <td>{{ product.product_brand}}</td>
                      <td>{{ product.product_size}}</td>
                      <td>{{ product.product_type}}</td>
                      <td>{{ product.unit_price}}</td>
                      <td>{{ product.selling_price}}</td>
                      <td>{{ product.reorder_level}}</td>
                      <td>{{ product.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                      <td><button type="button" class="btn btn-primary" @click="editModal(product)" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button></td>
                    </tr>
                  </tbody>
                </table>
                <div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {

            return {
              props: ['products'],
                editmode: false,
                products: {},
                vendors: {},
                form: new Form({
                    product_id: '',
                    product_name: '',
                    refill_new: '',
                    vendor_id: '',
                    product_brand: '',
                    product_size: '',
                    product_type: '',
                    unit_price: '',
                    selling_price: '',
                    reorder_level: '',
                    image: ''

                })
            }
        },

        methods: {
            updateProduct(){
              this.form.put('api/v1/products/'+this.form.product_id)
              .then(() => {
                $('#newModal').modal('hide');
                toast.fire({
                    icon: 'success',
                    title: 'Updated successfully'
                })

              })
              .catch(error => {
                    if (error.response.status == 422){
                      this.validationErrors = error.response.data.errors;
                      }
                })
            },
            editModal(product){
              this.editmode = true;
              this.form.reset();
              $('#newModal').modal('show');
              this.form.fill(product);
            },
            newModal(){
              this.editmode = false;
              this.form.reset();
              $('#newModal').modal('show');
            },
            loadProducts(){
                  axios.get('api/v1/products').then( ({ data }) => (
                    this.products = data.data,
                    this.vendors = data.vendor
                    ))
            },
            addProduct(){
                this.form.post('api/v1/products').then(() =>{
                  $('#newModal').modal('hide');
                   toast.fire({
                    icon: 'success',
                    title: 'Added successfully'
                })
                }).catch(error => {
                    if (error.response.status == 422){
                      this.validationErrors = error.response.data.errors;
                      }else if(error.response.status == 402){
                          toast.fire({
                          icon: 'warning',
                          title: 'This product exists!'
                      })
                      }
                })
            },
             productImage(e) {
                console.log('Uploading');
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                reader.onloadend = (file) =>  {
                    this.form.photo= reader.result;
                    console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            }
        },

        created() {
            this.loadProducts();/* 
            setInterval(() => this.loadProducts(), 4000); */
        },

        mounted(){
          //Product Name
            $('#product_brand, #product_size').bind('keypress blur', function() {
        
             $('#product_name').val($('#product_brand').val() + ' ' +
                              $('#product_size').val() );
            });

          //image preview
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
        }
    }
    
</script>
<style scoped>

</style>
