<template>
    <div class="container">
        <br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Assigned Orders</h5>

              
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>#ID</th>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Delivery Date & Time</th>
                    <th>Order Status</th>
                    <th>Location</th>
                    <th>Client Name</th>
                    <th>Client Phone</th>
                    <th>Rider Name</th>
                    <th>Rider phone</th>
                    <th>Assined Date</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="assignedorder in assignedorders" :key="assignedorder.id">
                      <td>{{ assignedorder.assignedOrder_id}}</td>
                      <td>{{ assignedorder.orders[0].order_id}}</td>
                      <td>{{ assignedorder.orders[0].totalprice}}</td>
                      <td>{{ assignedorder.orders[0].paymentmethod}}</td>
                      <td>{{ assignedorder.orders[0].deliveryDate}} | {{ assignedorder.orders[0].deliveryTime}}</td>
                      <td>{{ assignedorder.orders[0].orderstatus}}</td>
                      <td>{{ assignedorder.orders[0].locations.details}}</td>
                      <td>{{ assignedorder.orders[0].users.firstname}}  {{ assignedorder.orders[0].users.lastname}}</td>
                      <td>{{ assignedorder.orders[0].users.phone}}</td>
                      <td>{{ assignedorder.riders[0].firstname}} {{ assignedorder.riders[0].lastname}}</td>
                      <td>{{ assignedorder.riders[0].phone}}</td>
                      <td>{{ assignedorder.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
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
                assignedorders: {},
                orders: [],
                form: new Form({
                    assignedOrder_id: '',

                })
              
            }
        },

        methods: {
            loadassignedorders(){
                  axios.get('api/v1/assignedorders').then( ({ data }) => (
                    this.assignedorders = data.data,
                    this.orders = data.data


                    
                    ))
            
            },
        },

        created() {
            this.loadassignedorders();/* 
            setInterval(() => this.loadassignedorders(), 4000);  */ 
        }
        
    }
    
</script>
<style scoped>

</style>
