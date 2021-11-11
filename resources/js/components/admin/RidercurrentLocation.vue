
<template>
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Riders Locations</div>
                        
                    <div class="card-body">
               <gmap-map
                :zoom="11"
                :center="center"
                style="width:100%;  height: 600px;">
                <gmap-marker
                    v-for="(gmap, i) in locations"
                    :key="i"
                    :position="gmap"
                    @click="center=gmap"
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
        name: "MapMarker",
        data() {
            return {
            center: { lat:-1.2589350000000001, lng:36.77535 },
            locations: [],
            currentLoc: null
            };
        },
        
        mounted() {
            this.addLocations();
        },
        
        methods: {
            setPlace(loc) {
            this.currentLoc = loc;
            },
            addLocations: function() {
                navigator.geolocation.getCurrentPosition(geo => {
                this.center = {
                    lat: geo.coords.latitude,
                    lng: geo.coords.longitude
                };
                });
                
              axios.get('api/v1/ridersmap').then( ({ data }) => (this.locations = data.data))
            
         
                this.locations = [
                {
                    lat: -1.264298427318318,
                    lng: 36.7412082105875,
                    label: 'France'
                },
                {
                    lat: -1.2537397790136646,
                    lng: 36.70070920139552,
                    label: 'Sri Lanka'
                },
                {
                    lat: -1.284126111733027,
                    lng: 36.82036992162466,
                    label: 'Canada'
                }
            ];
        
            }
        }
    };
</script>
