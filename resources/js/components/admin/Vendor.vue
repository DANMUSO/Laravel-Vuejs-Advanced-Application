<template>
    <div class="container">
        <br>
       <div class="row " >
          <div class="col-12">
            <div class="card  card card-primary card-outline" >
              <div class="card-header">
                <h5 class="card-title">List of Vendors</h5>

                 <div class="card-tools">
                      <button class="btn btn-success" @click="newModal">
                      Add Vendor  <i class="fas fa-plus"></i>
                      </button>
                      
        <!-- Modal -->
       
      <div class="modal fade" id="newModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-show="!editmode">Add Vendor</h4>
              <h4 class="modal-title" v-show="editmode">Update Vendor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editmode ? updateVendor() : addVendor()">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Vendor's Name</label>
                        <input type="text" class="form-control" name="vendor_name" v-model="form.vendor_name" placeholder="Vendor Name">
                        <div v-if="form.errors.has('vendor_name')" style="color:red;" v-html="form.errors.get('vendor_name')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Physical Address</label>
                        <input type="text" class="form-control" name="vendor_address" v-model="form.vendor_address" placeholder="Vendor Address">
                       <div v-if="form.errors.has('vendor_address')" style="color:red;" v-html="form.errors.get('vendor_address')" />
                        </div>
                    
                    <div class="form-group col-md-6">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" name="person" v-model="form.person" placeholder="person">
                        <div v-if="form.errors.has('person')" style="color:red;" v-html="form.errors.get('person')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Contact Person Email</label>
                        <input type="email" class="form-control" name="email" v-model="form.email" placeholder="Email">
                        <div v-if="form.errors.has('email')" style="color:red;" v-html="form.errors.get('email')" />
                    </div>


                    <div class="form-group col-md-12">
                        <label for="">Contact Person Phone</label>
                        <input type="tel" class="form-control" id="telephone" name="phone" v-model="form.phone" placeholder="+254700000000">
                        <div v-if="form.errors.has('phone')" style="color:red;" v-html="form.errors.get('phone')" />
                    </div>
                        <div class="form-group col-md-6">
                        <label for="inputCity">Vendor's Photo</label>
                        <input type="file" @change="vendorImage" id="ImageMedias" class="form-control" name="image">
                        <div v-if="form.errors.has('photo')" v-html="form.errors.get('photo')" style="color:red;"/>
                        <div id="divImageMediaPreview"></div>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputCity">Attach Contract Document</label>
                        <input type="file" @change="vendorDoc" class="form-control" name="docs">
                        <div v-if="form.errors.has('doc')" v-html="form.errors.get('doc')" style="color:red;"/>
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
                    <th>Vendor <br>ID</th>
                    <th>Vendor <br> Photo</th>
                    <th>Vendor's <br> Name</th>
                    <th>Physical <br> Address</th>
                    <th>Contact <br> person Phone</th>
                    <th>Contact <br> Person</th>
                    <th>Contact <br> person Email</th>
                    <th>Contract <br> Document</th>
                    <th>Created at</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="vendor in vendors" :key="vendor.id">
                      <td style="width:25px">{{ vendor.vendor_id}}</td>
                      <td style="width:25px"><img v-bind:src="vendor.image" width="100%"/></td>
                      <td style="width:25px">{{ vendor.vendor_name}}</td>
                      <td class="size">{{ vendor.vendor_address}}</td>
                      <td style="width:25px">{{ vendor.phone}}</td>
                      <td style="width:25px">{{ vendor.person}}</td>
                      <td style="width:25px">{{ vendor.email}}</td>
                      <td style="width:25px"><a v-bind:href="vendor.doc" target="_blank" download="Brochure">Download Contract</a></td>
                      <td style="width:25px">{{ vendor.created_at | moment("MMMM Do YYYY [at] hh:mm") }}</td>
                      <td><button type="button" class="btn btn-primary" @click="editModal(vendor)" aria-label="Left Align">
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
                vendors: {},
                form: new Form({
                    vendor_id: '',
                    vendor_name: '',
                    vendor_address: '',
                    phone: '',
                    person: '',
                    email: '',
                    docs: '',
                    image: ''

                })
            }
        },

        methods: {
            updateVendor(){
              this.form.put('api/v1/vendors/'+this.form.vendor_id)
              .then(() => {
                $('#newModal').modal('hide');
                 toast.fire({
                    icon: 'success',
                    title: 'Vendor updated successfully'
                })
              })
              .catch(() => {

              })
            },
            editModal(vendor){
              this.editmode = true;
              this.form.reset();
              $('#newModal').modal('show');
              this.form.fill(vendor);
            },
            newModal(){
              this.editmode = false;
              this.form.reset();
              $('#newModal').modal('show');
            },
            loadVendors(){
                  axios.get('api/v1/vendors').then( ({ data }) => (this.vendors = data.data))
            
            },
            addVendor(){
                this.form.post('api/v1/vendors').then(() =>{
                  $('#newModal').modal('hide');
                   toast.fire({
                    icon: 'success',
                    title: 'Vendor added successfully'
                })
                }).catch(() => {
                    
                })
            },
             vendorImage(e) {
                console.log('Uploading');
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                reader.onloadend = (file) =>  {
                    this.form.photo= reader.result;
                    console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            },
            vendorDoc(e) {
                console.log('Uploading');
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                reader.onloadend = (file) =>  {
                    this.form.doc= reader.result;
                    //console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            }
        },

        created() {
            this.loadVendors();
            setInterval(() => this.loadVendors(), 10000); 
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
