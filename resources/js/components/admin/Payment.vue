<template>
    <div class="container">
        <br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Transactions</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>Payment ID</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Destination</th>
                    <th>Destination Type</th>
                    <th>Product Name</th>
                    <th>Provider</th>
                    <th>Provider Channel</th>
                    <th>Provider Ref Id</th>
                    <th>Source</th>
                    <th>Source Type</th>
                    <th>Transaction Status</th>
                    <th>Value</th>
                    <th>Transaction Date</th>
                    <th>TTransaction Fee</th>
                    <th>Transaction Id</th>
                    <th>Request Meta Data</th>
                    <th>Transaction Provider Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="payment in payments" :key="payment.id">
                      
                    <td>{{ payment.payment_id }}</td>
                    <td>{{ payment.category }}</td>
                    <td>{{ payment.description }}</td>
                    <td>{{ payment.destination}}</td>
                    <td>{{ payment.destinationType}}</td>
                    <td>{{ payment.productName}}</td>
                    <td>{{ payment.provider}}</td>
                    <td>{{ payment.providerChannel}}</td>
                    <td>{{ payment.providerRefId}}</td>
                    <td>{{ payment.source}}</td>
                    <td>{{ payment.sourceType}}</td>
                    <td>{{ payment.status}}</td>
                    <td>{{ payment.value}}</td>
                    <td>{{ payment.transactionDate}}</td>
                    <td>{{ payment.transactionFee}}</td>
                    <td>{{ payment.transactionId}}</td>
                    <td>{{ payment.requestMetadata}}</td>
                    <td>{{ payment.providerFee}}</td>
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
                payments: {},
                form: new Form({
                    payment_id: '',

                })
              
            }
        },

        methods: {
            loadpayments(){
                  axios.get('api/v1/payments').then( ({ data }) => (
                    this.payments = data.data
                    ))
            
            },
        },

        created() {
            this.loadpayments();/* 
            setInterval(() => this.loadpayments(), 4000);  */ 
        }
        
    }
    
</script>
<style scoped>

</style>
