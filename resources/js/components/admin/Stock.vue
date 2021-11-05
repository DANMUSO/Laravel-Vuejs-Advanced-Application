<template>
    <div class="container">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Current Stock</div>
                    <br>
                    <div class="row">
                    <div class="col-sm-4" v-for="stock in stocks" :key="stock.id" :value="stock.id">
                        <center>
                        <div class="card">
                            <h5>{{stock.vendor_name}}</h5>
                        <div class="card-body">
                            <img v-bind:src="stock.image" width="30%"/>
                            <p>Capacity: {{stock.product_name}} {{stock.refill_new}} </p>
                            <p>Quantity: {{stock.stock_quantity}}</p>

                          
                        </div>
                        </div>
                        </center>
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
        },
        data() {
            return {
              stocks: [],
            };
        },
        methods: {
             loadStocks(){
                  axios.get('api/v1/stocks').then( ({ data }) => (
                    this.stocks = data.data
                    ))
            },
        },
        created() {
            this.loadStocks();/* 
            setInterval(() => this.loadStocks(), 4000); */
        },

    }
</script>
