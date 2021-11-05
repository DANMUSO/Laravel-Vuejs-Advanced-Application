<template>
    <div class="container">
        <br><br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Purchase Orders</h5>

                 <div class="card-tools">
                      <button class="btn btn-success" @click="newModal">
                      Add Purchase Order  <i class="fas fa-plus"></i>
                      </button>
                      
        <!-- Modal -->
       
      <div class="modal fade" id="newModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-show="!editmode">Add Purchase Order</h4>
              <h4 class="modal-title" v-show="editmode">Update Purchase Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editmode ? updatePurchaseorders() : addPurchaseorders()">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Select Vendor:</label>
                            <select class='form-control' v-model='vendor' @change='getVendors()'>
                              <option v-for='data in vendors'  :key="data.id" v-bind:value='data.vendor_id'>{{ data.vendor_name }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Product name</label>
                        <select class="form-control" name="product_name" v-model="form.product_name">
                          
                        <option v-for='data in products' :key="data.id" v-bind:value='data.product_id'>{{ data.product_name }}</option>
                        </select>
                        <div v-if="form.errors.has('product_name')" style="color:red;" v-html="form.errors.get('product_name')" />
                        </div>
                       
                    
                    <div class="form-group col-md-6">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" v-model="form.quantity" @change="updateQuantity" placeholder="Quantity">
                        <div v-if="form.errors.has('quantity')" style="color:red;" v-html="form.errors.get('quantity')" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="">Unit Price</label>
                        <input type="number" v-model="form.unit_price" id="unit_price" class="form-control" name="unit_price" @change="updateUnit" placeholder="Unit Price">
                        <div v-if="form.errors.has('unit_price')" style="color:red;" v-html="form.errors.get('unit_price')" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Tax</label>
                        <input type="number"  class="form-control" v-model="form.tax" id="tax" name="tax" @change="updateTax" placeholder="Tax">
                        <div v-if="form.errors.has('tax')" style="color:red;" v-html="form.errors.get('tax')" />
                    </div>
                     <div class="form-group col-md-6">
                        <label for="">Total</label>
                        <input type="number" class="form-control" disabled="disabled" name="total" id="total" v-model="form.total" placeholder="Total">
                        <div v-if="form.errors.has('total')" style="color:red;" v-html="form.errors.get('total')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Date of Purchase</label>
                        <input type="date" class="form-control" name="dop" v-model="form.dop" placeholder="Date of Purchase">
                        <div v-if="form.errors.has('dop')" style="color:red;" v-html="form.errors.get('dop')" />
                    </div>
                     <div class="form-group col-md-6">
                        <label for="">Purchase order Number</label>
                        <input type="text" class="form-control" name="ordernumber" v-model="form.ordernumber" placeholder="Purchase order Number">
                        <div v-if="form.errors.has('ordernumber')" style="color:red;" v-html="form.errors.get('ordernumber')" />
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
                    <th>Product Brand</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Date of Purchase</th>
                    <th>Purchase Order Number</th>
                    <th>Created at</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="purchaseorder in purchaseorders" :key="purchaseorder.id">
                    <td>{{ purchaseorder.product_id}}</td>
                    <td v-for="product in purchaseorder.products" :key="product">{{ product.product_brand}}</td>
                    <td v-for="product in purchaseorder.products" :key="product">{{ product.product_name}}</td>
                    <td>{{ purchaseorder.quantity}}</td>
                    <td>{{ purchaseorder.unit_price}}</td>
                    <td>{{ purchaseorder.tax}}</td>
                    <td>{{ purchaseorder.total}}</td>
                    <td>{{ purchaseorder.dop}}</td>
                    <td>{{ purchaseorder.ordernumber}}</td>
                      <td>{{ purchaseorder.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                      <td><button type="button" class="btn btn-primary" @click="editModal(purchaseorder)" aria-label="Left Align">
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
                vendor: 0,
                product: 0,
                products: [],
              props: ['products'],
                editmode: false,
                purchaseorders: [],
                vendors: {},
                form: new Form({
                    porder_id: '',
                    product_brand: '',
                    product_id:'',
                    quantity:'',
                    unit_price:'',
                    tax:'',
                    total:'',
                    dop:'',
                    ordernumber:''

                })
            }
        },

        methods: {
                    updateQuantity(event) {
                      this.form.quantity = event.target.value
                      this.form.total = this.form.quantity * this.form.unit_price + (this.form.quantity * this.form.unit_price)* this.form.tax/100
                    },
                    updateUnit(event) {
                      this.form.sale_rate = event.target.value
                      this.form.total = this.form.quantity * this.form.unit_price + (this.form.quantity * this.form.unit_price) * this.form.tax/100
                    },
                     updateTax(event) {
                      this.form.tax = event.target.value
                      this.form.total = this.form.quantity * this.form.unit_price + (this.form.quantity * this.form.unit_price)* this.form.tax/100
                    },
             getVendors: function() {
                axios.get('/api/v1/getproducts',{
                 params: {
                   vendor_id: this.vendor
                 }
              }).then(function(response){
                    this.products = response.data;
                }.bind(this));
            },
            updatePurchaseorders(){
              console.log('Updating');
              this.form.put('api/v1/purchaseorders/'+this.form.porder_id)
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
            editModal(purchaseorder){
              this.editmode = true;
              this.form.reset();
              $('#newModal').modal('show');
              this.form.fill(purchaseorder);
            },
            newModal(){
              this.editmode = false;
              this.form.reset();
              $('#newModal').modal('show');
            },
            loadPurchaseorders(){
                  axios.get('api/v1/purchaseorders').then( ({ data }) => (
                    this.purchaseorders = data.data,
                    this.vendors = data.vendor
                    ))
            },
            addPurchaseorders(){
                this.form.post('api/v1/purchaseorders').then(() =>{
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
            }
        },
        created: function(){
            this.get_Vendors()
        },
        created() {
            this.loadPurchaseorders();/* 
            setInterval(() => this.loadPurchaseorders(), 4000); */
        },

        mounted(){
        }
    }
    
</script>
<style scoped>

</style>
