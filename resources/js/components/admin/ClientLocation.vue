<template>
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Client Location Component</div>

                    <div class="card-body">
                        <gmap-map
                    :center="center"
                    :zoom="12"
                    style="width:100%;  height: 400px;"
                    >
                    <gmap-marker
                        :key="index"
                        v-for="(m, index) in markers"
                        :position="m"
                        @click="center=m"
                    ></gmap-marker>
                        </gmap-map>
                       
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
              center: { lat:-1.2589350000000001, lng:36.77535 },
              markers: [],
            };
        },
        methods: {    
     geolocate: function() {
        navigator.geolocation.getCurrentPosition(position => {
          this.center = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
        });
        this.markers = [
          {
              lat: -1.2589350000000001,
              lng: 36.77535,
              label: 'Surat'
          },
          {
              lat: -1.2589350000000001,
              lng: 36.77535,
              label: 'Surat'
          },
          {
             lat: -1.2589350000000001,
              lng: 36.77535,
              label: 'Surat'
          }
      ];
    }
        }
    }
</script>
