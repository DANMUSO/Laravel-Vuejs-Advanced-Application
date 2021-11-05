<template>
    <div class="container">
        <br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of riders</h5>

                 <div class="card-tools">
                      <button class="btn btn-success" @click="newModal">
                      Add rider  <i class="fas fa-plus"></i>
                      </button>
                      
        <!-- Modal -->
       
      <div class="modal fade" id="newModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-show="!editmode">Add Rider</h4>
              <h4 class="modal-title" v-show="editmode">Update Rider</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editmode ? updateRider() : addRider()">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">First Name</label>
                        <input type="text" class="form-control" name="firstname" v-model="form.firstname" placeholder="First Name">
                        <div v-if="form.errors.has('firstname')" style="color:red;" v-html="form.errors.get('firstname')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" name="lastname" v-model="form.lastname" placeholder="Last Name">
                       <div v-if="form.errors.has('lastname')" style="color:red;" v-html="form.errors.get('lastname')" />
                        </div>
                    
                        <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" v-model="form.email" placeholder="Email">
                        <div v-if="form.errors.has('email')" style="color:red;" v-html="form.errors.get('email')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Phone</label>
                        <input type="tel" class="form-control" id="telephone" name="phone" v-model="form.phone" placeholder="+254700000000">
                        <div v-if="form.errors.has('phone')" style="color:red;" v-html="form.errors.get('phone')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Depot</label>
                        <input type="text" class="form-control" name="depot" v-model="form.depot" placeholder="Depot">
                        <div v-if="form.errors.has('depot')" style="color:red;" v-html="form.errors.get('depot')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Number Plate</label>
                        <input type="text" class="form-control" name="numberplate" v-model="form.numberplate" placeholder="Number Plate">
                        <div v-if="form.errors.has('numberplate')" style="color:red;" v-html="form.errors.get('numberplate')" />
                        </div>
                        <br>
                        <div class="form-group col-md-12">
                        <label for="inputCity">Rider's Photo</label>
                        <input type="file" @change="riderImage" id="ImageMedias" class="form-control" name="image">
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
                    <th>Rider ID</th>
                    <th>Rider Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Status</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Number Plate</th>
                    <th>Depot</th>
                    <th>Created at</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="rider in riders" :key="rider.id">
                      <td>{{ rider.rider_id}}</td>
                      <td><img v-bind:src="rider.image" width="100%"/></td>
                      <td>{{ rider.firstname}}</td>
                      <td>{{ rider.lastname}}</td>
                      <td>{{ rider.status}}</td>
                      <td>{{ rider.phone}}</td>
                      <td>{{ rider.email}}</td>
                      <td>{{ rider.numberplate}}</td>
                      <td>{{ rider.depot}}</td>
                      <td>{{ rider.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                      <td><button type="button" class="btn btn-primary" @click="editModal(rider)" aria-label="Left Align">
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
                editmode: false,
                riders: {},
                form: new Form({
                    rider_id: '',
                    status: '',
                    firstname: '',
                    lastname: '',
                    phone: '',
                    email: '',
                    numberplate: '',
                    depot: '',
                    image: ''

                })
            }
        },

        methods: {
            updateRider(){
              this.form.put('api/v1/riders/'+this.form.rider_id)
              .then(() => {
                $('#newModal').modal('hide');
                 toast.fire({
                    icon: 'success',
                    title: 'Rider updated successfully'
                })
              })
              .catch(() => {

              })
            },
            editModal(rider){
              this.editmode = true;
              this.form.reset();
              $('#newModal').modal('show');
              this.form.fill(rider);
            },
            newModal(){
              this.editmode = false;
              this.form.reset();
              $('#newModal').modal('show');
            },
            loadRiders(){
                  axios.get('api/v1/riders').then( ({ data }) => (this.riders = data.data))
            
            },
            addRider(){
                this.form.post('api/v1/riders').then(() =>{
                  $('#newModal').modal('hide');
                   toast.fire({
                    icon: 'success',
                    title: 'Rider added successfully'
                })
                }).catch(() => {
                    
                })
            },
             riderImage(e) {
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
            this.loadRiders();/* 
            setInterval(() => this.loadRiders(), 4000);   */
        },
        mounted(){
          //Image preview
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
