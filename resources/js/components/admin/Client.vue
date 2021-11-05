<template>
    <div class="container">
        <br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Clients</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>#ID</th>
                    <th>Client Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Registered Date</th>
               
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="client in clients" :key="client.id">
                      <td>{{client.user_id}}</td>
                      <td>{{client.firstname }} {{client.lastname }}</td>
                      <td>{{client.phone}}</td>
                      <td>{{client.email}}</td>
                      <td>{{ client.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
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
                clients: {},
              
            }
        },

        methods: {
            loadclients(){
                  axios.get('api/v1/clients').then( ({ data }) => (
                    this.clients = data.data
                    ))
            
            },
        },

        created() {
            this.loadclients();/* 
            setInterval(() => this.loadclients(), 4000);  */ 
        }
        
    }
    
</script>
<style scoped>

</style>
