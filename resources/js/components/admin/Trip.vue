<template>
    <div class="container">
        <br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Trips</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     <th>#ID</th>
                    <th>#Order Id</th>
                    <th>Trip Status</th>
                    <th>Client's Name</th>
                    <th>Rider's Name</th>
                    <th>Destination</th>
                    <th>Delivered Date & Time</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="trip in trips" :key="trip.id">
                      <td>{{ trip.trip_id }}</td>
                      <td>{{trip.order_id}}</td>
                      <td>{{trip.tripstatus}}</td>
                      <td>{{trip.orders.users.firstname}}  {{trip.orders.users.lastname}}</td>
                      <td>{{trip.riders.firstname}}  {{trip.riders.lastname}}</td>
                      <td>{{trip.orders.locations.details}}</td>
                      <td>{{ trip.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
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
                trips: {},
                form: new Form({
                    trip_id: '',

                })
              
            }
        },

        methods: {
            loadtrips(){
                  axios.get('api/v1/trips').then( ({ data }) => (
                    this.trips = data.data
                    ))
            
            },
        },

        created() {
            this.loadtrips();/* 
            setInterval(() => this.loadtrips(), 4000);  */ 
        }
        
    }
    
</script>
<style scoped>

</style>
