<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile Component</div>

                    <div class="card-body">
                         <form @submit="formSubmit" enctype="multipart/form-data">
                        <strong>Name:</strong>
                        <input type="text" class="form-control" v-model="name">
                        <strong>Image:</strong>
                        <input type="file" class="form-control" v-on:change="onImageChange">
 
                        <button class="btn btn-success">Submit</button>
                        </form>
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
              name: '',
              image: '',
              success: ''
            };
        },
        methods: {
            onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                formData.append('image', this.image);
 
                axios.post('api/v1/vendors', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>
