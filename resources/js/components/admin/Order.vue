<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
              <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-failed-tab" data-toggle="pill" href="#custom-tabs-four-failed" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><b>Failed Payment Orders <b style="color:green">{{number.no1}}</b></b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-confirm-tab" data-toggle="pill" href="#custom-tabs-four-confirm" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><b>Confirmed Orders  <b style="color:green">{{number.no2}}</b></b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-transit-tab" data-toggle="pill" href="#custom-tabs-four-transit" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false"><b>In Transit Orders <b style="color:green">{{number.no3}}</b></b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-conplete-tab" data-toggle="pill" href="#custom-tabs-four-conplete" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false"><b>Delivered Orders <b style="color:green">{{number.no4}}</b></b></a>
                  </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-cancel-tab" data-toggle="pill" href="#custom-tabs-four-cancel" role="tab" aria-controls="custom-tabs-four-cancel" aria-selected="false"><b>Cancelled Orders <b style="color:green">{{number.no5}}</b></b></a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-four-failed" role="tabpanel" aria-labelledby="custom-tabs-four-failed-tab">
                  <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Customer Address</th>
                    
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    <tr v-for="order in orders.order1" :key="order.id">
                    <td>
                      
                       
                    <button type="button" @click="FailedOrder(order.order_id)" class="btn btn-primary"  data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i></button>
                    {{ order.order_id}}
                    </td>
                    <td>
                        {{ order.users.firstname}}  {{ order.users.lastname}}
                    </td>
                    <td>
                        {{ order.users.phone}}
                    </td>
                    <td>
                        {{ order.users.email}}
                    </td>
                     <td>
                         {{ order.paymentmethod}}
                    </td>
                    <td>
                        {{ order.transactionstatus}}
                    </td>
                    <td>
                         {{ order.payments ? order.payments.description: ''}}
                    </td>
                    <td>
                         {{ order.locations.title}}
                    </td>
                    <td>
                        {{ order.orderstatus}}
                    </td>
                    <td>
                        {{ order.totalprice}}
                    </td>
                    <td>
                        {{ order.deliveryDate}}
                    </td>
                    <td>
                        {{ order.deliveryTime}}
                    </td>
                  
                    </tr>
                    </table>
                     <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="orderdetails" tabindex="-1" role="dialog" aria-labelledby="orderdetailsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="margin-right:10%;">
                            <div class="modal-content">
                            <div class="modal-header" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 40px 20px; heigth:10px;">
                                <h5 class="modal-title" id="orderdetailsLabel">Order Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-md-9">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8" >
                                <div v-for="fd in fdorder.slice(0,1)" :key="fd.id">
                            <button type="submit"  class="btn btn-success"  @click="ReprocessPayment(fd.order_id)">
                                Reprocess Payment
                            </button>
                            </div>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div v-for="fd in fdorder.slice(0,1)" :key="fd.id">
                            <button type="submit"  class="btn btn-danger"  @click="CancelFailedOrder(fd.order_id)">
                                Cancel Order
                            </button>
                            </div>
                            </div>
                            </div>
                            <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID<th>Product Photo</th><th>Product ID</th><th>Product Name</th><th>Vendor Name</th><th>Quantity Ordered</th><th>Total</th><th>Product Ordered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr v-for="fd in failedorder" :key="fd.id">
                                    <td>{{fd.order_id}}<br></td>
                                    <td><img v-bind:src="fd.products.image" width="100%"/></td>
                                    <td>{{fd.product_id}}</td>
                                    <td>{{fd.products.product_name}}</td>
                                    <td>{{fd.products.product_brand}}</td>
                                    <td>{{fd.units_order}}</td>
                                    <td>{{fd.total_price}}</td>
                                    <td>{{ fd.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>

                  </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-confirm" role="tabpanel" aria-labelledby="custom-tabs-four-confirm-tab">
                   <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Customer Address</th>
                    
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    <tr v-for="order in orders.order2" :key="order.id">
                    <td>
                    <!-- Button trigger modal -->
                    <button type="button" @click="ConfirmedOrder(order.order_id)" class="btn btn-primary" data-toggle="modal" data-target="#confirmedorder">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i>
                    </button>
                    {{ order.order_id}}
                    </td>
                    <td>
                        {{ order.users.firstname}}  {{ order.users.lastname}}
                    </td>
                    <td>
                        {{ order.users.phone}}
                    </td>
                    <td>
                        {{ order.users.email}}
                    </td>
                     <td>
                         {{ order.paymentmethod}}
                    </td>
                    <td>
                        {{ order.transactionstatus}}
                    </td>
                    <td>
                         {{ order.payments ? order.payments.description: ''}}
                    </td>
                    <td>
                         {{ order.locations.title}}
                    </td>
                    <td>
                        {{ order.orderstatus}}
                    </td>
                    <td>
                        {{ order.totalprice}}
                    </td>
                    <td>
                        {{ order.deliveryDate}}
                    </td>
                    <td>
                        {{ order.deliveryTime}}
                    </td>
                  
                    </tr>
                    </table>
                   

                    <!-- Modal -->
                    <div class="modal fade" id="confirmedorder" tabindex="-1" role="dialog" aria-labelledby="confirmedorderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-right:10%;">
                        <div class="modal-content">
                        <div class="modal-header" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 40px 20px; heigth:10px;">
                            <h5 class="modal-title" id="confirmedorderLabel">Confirmed order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                  <div class="col-md-12">
                                    <div class="x_panel">
                                        <div class="x_title" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 30px 20px; heigth:10px;">
                                        <center><h5>Assign this order to the available rider</h5></center>
                                        
                                        </div>
                                        <br>
                                        <div class="x_content">
                                            <div class="card" v-for="rider in riders" :key="rider.id">
                                            <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-8">
                                                     <span class="image">
                                                <img v-bind:src="rider.riders.image" width="10%"/>
                                                </span>
                                                <span style="color:#000"><b>#ID</b> {{rider.rider_id}} <br>
                                                {{rider.riders.firstname}} {{rider.riders.lastname}}<br>
                                                <b>{{rider.riders.phone}}</b>
                                                </span>
                                                <br>
                                                <button v-for="fd in confirmedorder.slice(0,1)" :key="fd.id" type="submit"  class="btn btn-success"  @click="Transit(fd.order_id,rider.rider_id)">Assign Order</button>
          
                                                </div>
                                                 <div class="col-md-3">
                                                     <span class="time"><b>Time:</b> {{rider.time}}</span><br>
                                                <span class="time"><b>Distance:</b> {{rider.distance}}  Km</span><br>
                                                <span class="time" style="color:green">Online</span>
                                                
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID<th>Product Photo</th><th>Product ID</th><th>Product Name</th><th>Vendor Name</th><th>Quantity Ordered</th><th>Total</th><th>Product Ordered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr v-for="fd in confirmedorder" :key="fd.id">
                                    <td>{{fd.order_id}}<br></td>
                                    <td><img v-bind:src="fd.products.image" width="100%"/></td>
                                    <td>{{fd.product_id}}</td>
                                    <td>{{fd.products.product_name}}</td>
                                    <td>{{fd.products.product_brand}}</td>
                                    <td>{{fd.units_order}}</td>
                                    <td>{{fd.total_price}}</td>
                                    <td>{{ fd.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal -->
                  </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-transit" role="tabpanel" aria-labelledby="custom-tabs-four-transit-tab">
                  <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Customer Address</th>
                    
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    <tr v-for="order in orders.order3" :key="order.id">
                    <td>
                     <!-- Button trigger modal -->
                    <button type="button" @click="TransitOrder(order.order_id)" class="btn btn-primary" data-toggle="modal" data-target="#transitorder">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i>
                    </button>
                    {{ order.order_id}}
                    </td>
                    <td>
                        {{ order.users.firstname}}  {{ order.users.lastname}}
                    </td>
                    <td>
                        {{ order.users.phone}}
                    </td>
                    <td>
                        {{ order.users.email}}
                    </td>
                     <td>
                         {{ order.paymentmethod}}
                    </td>
                    <td>
                        {{ order.transactionstatus}}
                    </td>
                    <td>
                         {{ order.payments ? order.payments.description: ''}}
                    </td>
                    <td>
                         {{ order.locations.title}}
                    </td>
                    <td>
                        {{ order.orderstatus}}
                    </td>
                    <td>
                        {{ order.totalprice}}
                    </td>
                    <td>
                        {{ order.deliveryDate}}
                    </td>
                    <td>
                        {{ order.deliveryTime}}
                    </td>
                  
                    </tr>
                    </table>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="transitorder" tabindex="-1" role="dialog" aria-labelledby="transitorderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-right:10%;">
                        <div class="modal-content">
                        <div class="modal-header" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 40px 20px; heigth:10px;">
                            <h5 class="modal-title" id="transitorderLabel">In transit order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID<th>Product Photo</th><th>Product ID</th><th>Product Name</th><th>Vendor Name</th><th>Quantity Ordered</th><th>Total</th><th>Product Ordered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr v-for="fd in transitorder" :key="fd.id">
                                    <td>{{fd.order_id}}<br></td>
                                    <td><img v-bind:src="fd.products.image" width="100%"/></td>
                                    <td>{{fd.product_id}}</td>
                                    <td>{{fd.products.product_name}}</td>
                                    <td>{{fd.products.product_brand}}</td>
                                    <td>{{fd.units_order}}</td>
                                    <td>{{fd.total_price}}</td>
                                    <td>{{ fd.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                                    </tr>
                                </tbody>
                                </table>
                                 <div class="x_title" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 30px 20px; heigth:10px;">
                                        <center><h5>You can complete this order if rider encounter any issue in scanning QR Code.</h5>
                                        
                                         <div v-for="fd in torder.slice(0,1)" :key="fd.id">
                                         <button type="submit"  class="btn btn-success"  @click="CompleteOrder(fd.order_id)">
                                                Complete Order
                                          </button>
                                          </div>
                                        </center>

                                        
                                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal -->
                  </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-conplete" role="tabpanel" aria-labelledby="custom-tabs-four-conplete-tab">
                  <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Customer Address</th>
                    
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    <tr v-for="order in orders.order4" :key="order.id">
                    <td>
                    <!-- Button trigger modal -->
                    <button type="button" @click="CompletedOrder(order.order_id)" class="btn btn-primary" data-toggle="modal" data-target="#completedorder">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i>
                    </button>
                    {{ order.order_id}}
                    </td>
                    <td>
                        {{ order.users.firstname}}  {{ order.users.lastname}}
                    </td>
                    <td>
                        {{ order.users.phone}}
                    </td>
                    <td>
                        {{ order.users.email}}
                    </td>
                     <td>
                         {{ order.paymentmethod}}
                    </td>
                    <td>
                        {{ order.transactionstatus}}
                    </td>
                    <td>
                         {{ order.payments ? order.payments.description: ''}}
                    </td>
                    <td>
                         {{ order.locations.title}}
                    </td>
                    <td>
                        {{ order.orderstatus}}
                    </td>
                    <td>
                        {{ order.totalprice}}
                    </td>
                    <td>
                        {{ order.deliveryDate}}
                    </td>
                    <td>
                        {{ order.deliveryTime}}
                    </td>
                  
                    </tr>
                    </table>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="completedorder" tabindex="-1" role="dialog" aria-labelledby="completedorderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-right:10%;">
                        <div class="modal-content">
                        <div class="modal-header" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 40px 20px; heigth:10px;">
                            <h5 class="modal-title" id="completedorderLabel">Completed order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID<th>Product Photo</th><th>Product ID</th><th>Product Name</th><th>Vendor Name</th><th>Quantity Ordered</th><th>Total</th><th>Product Ordered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr v-for="fd in completedorder" :key="fd.id">
                                    <td>{{fd.order_id}}<br></td>
                                    <td><img v-bind:src="fd.products.image" width="100%"/></td>
                                    <td>{{fd.product_id}}</td>
                                    <td>{{fd.products.product_name}}</td>
                                    <td>{{fd.products.product_brand}}</td>
                                    <td>{{fd.units_order}}</td>
                                    <td>{{fd.total_price}}</td>
                                    <td>{{ fd.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal -->
                  </div>
                  </div>
                   <div class="tab-pane fade" id="custom-tabs-four-cancel" role="tabpanel" aria-labelledby="custom-tabs-four-cancel-tab">
                   <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Customer Address</th>
                    
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    <tr v-for="order in orders.order5" :key="order.id">
                    <td> 
                    <!-- Button trigger modal -->
                    <button type="button" @click="CancelledOrder(order.order_id)" class="btn btn-primary" data-toggle="modal" data-target="#cancelorder">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i>
                    </button>
                    {{ order.order_id}}
                    </td>
                    <td>
                        {{ order.users.firstname}}  {{ order.users.lastname}}
                    </td>
                    <td>
                        {{ order.users.phone}}
                    </td>
                    <td>
                        {{ order.users.email}}
                    </td>
                     <td>
                         {{ order.paymentmethod}}
                    </td>
                    <td>
                        {{ order.transactionstatus}}
                    </td>
                    <td>
                        {{ order.payments ? order.payments.description: ''}}
                    </td>
                    <td>
                         {{ order.locations.title}}
                    </td>
                    <td>
                        {{ order.orderstatus}}
                    </td>
                    <td>
                        {{ order.totalprice}}
                    </td>
                    <td>
                        {{ order.deliveryDate}}
                    </td>
                    <td>
                        {{ order.deliveryTime}}
                    </td>
                  
                    </tr>
                    </table>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="cancelorder" tabindex="-1" role="dialog" aria-labelledby="cancelorderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-right:10%;">
                        <div class="modal-content">
                        <div class="modal-header" style="background-color:#C71585; color:#fff; border: 2px solid red;padding: 6px;border-radius: 40px 20px; heigth:10px;">
                            <h5 class="modal-title" id="cancelorderLabel">Cancelled order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID<th>Product Photo</th><th>Product ID</th><th>Product Name</th><th>Vendor Name</th><th>Quantity Ordered</th><th>Total</th><th>Product Ordered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr v-for="fd in cancelledorder" :key="fd.id">
                                    <td>{{fd.order_id}}<br></td>
                                    <td><img v-bind:src="fd.products.image" width="100%"/></td>
                                    <td>{{fd.product_id}}</td>
                                    <td>{{fd.products.product_name}}</td>
                                    <td>{{fd.products.product_brand}}</td>
                                    <td>{{fd.units_order}}</td>
                                    <td>{{fd.total_price}}</td>
                                    <td>{{ fd.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal -->
                  </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            </div>
        </div>
    </div>
</template>

<script>
   export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
              orders:[],
              failedorder:{},
              fdorder:[],
              torder:[],
              riders:{},
              confirmedorder:{},
              transitorder:{},
              completedorder:{},
              cancelledorder:{},
              number: {},
               form: new Form({
                    order_id: '',
                })
            };
        },
        methods: {
            FailedOrder(order_id)
            {
                  axios.get('api/v1/failedorder/'+order_id).then(({ data }) =>{
                      this.failedorder = data.data,
                      this.fdorder = data.data,
                      console.log('Failed transaction response!');
                      $('#failedorder').modal('show');
                  });
            },
            ConfirmedOrder(order_id)
            {
                  axios.get('api/v1/confirmedorder/'+order_id).then(({ data }) =>{
                      this.confirmedorder = data.data,
                      this.riders = data.riders,
                      console.log('Confirmed transaction response!');
                      $('#confirmedorder').modal('show');
                  });
            },
            TransitOrder(order_id)
            {
                  axios.get('api/v1/transitorder/'+order_id).then(({ data }) =>{
                      this.transitorder = data.data,
                      this.torder = data.data,
                      console.log('Transit transaction response!');
                      $('#transitorder').modal('show');
                  });
            },
            Transit(order_id,rider_id)
            {
                       var ids = order_id + ' ' + rider_id;
                  axios.get('api/v1/transit/'+ids).then(({ data }) =>{
                      this.transit = data.data,
                      $('#confirmedorder').modal('hide');
                      toast.fire({
                          icon: 'success',
                          title: 'Order is assigned to rider successfully!'
                      })
                      
                  });
            },
            ReprocessPayment(order_id)
            {
                swal.fire({
                title: 'Are you sure?',
                text: "You want to reprocess payment!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reprocess it!'
                }).then((result) => {
                   
                if (result.isConfirmed) {
                    axios.get('api/v1/reprocesspayment/'+order_id).then(({ data }) =>{
                      this.transit = data.data,
                      toast.fire({
                          icon: 'success',
                          title: 'Order payment is reprocessed successfully!'
                      })
                      
                  });
                }
                })
                  
            },
             CancelFailedOrder(order_id)
            {
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel it!'
                }).then((result) => {
                   
                if (result.isConfirmed) {
                     axios.get('api/v1/cancelfailedorder/'+order_id).then(({ data }) =>{
                      this.transit = data.data,
                      toast.fire({
                          icon: 'success',
                          title: 'Order cancelled successfully!'
                      })
                      
                  });
                }
                })
                 
            },
            CompletedOrder(order_id)
            {
                      console.log(order_id);
                  axios.get('api/v1/completedorder/'+order_id).then(({ data }) =>{
                      this.completedorder = data.data,
                      console.log('Complete transaction response!');
                      $('#completedorder').modal('show');
                  });
            },
            CancelledOrder(order_id)
            {
                      console.log(order_id);
                  axios.get('api/v1/cancelledorder/'+order_id).then(({ data }) =>{
                      this.cancelledorder = data.data,
                      console.log('Cancelled transaction response!');
                      $('#cancelledorder').modal('show');
                  });
            },
            CompleteOrder(order_id)
            {
                  swal.fire({
                title: 'Are you sure?',
                text: "You want to complete this Order!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
                }).then((result) => {
                   
                if (result.isConfirmed) {
                    axios.get('api/v1/completeorder/'+order_id).then(({ data }) =>{
                      this.cancelledorder = data.data,
                       toast.fire({
                          icon: 'success',
                          title: 'Order completed successfully!'
                      })
                  });
                }
                })
                 
            },
            loadOrders(){
                  axios.get('api/v1/orders').then( ({ data }) => (
                    this.orders = data.data,
                    this.number = data.number
                    
                    ))
            },
        },

        created() {
            this.loadOrders();/* 
            setInterval(() => this.loadOrders(), 10000); */
        }, 
        mounted(){

        }
    }
</script>
