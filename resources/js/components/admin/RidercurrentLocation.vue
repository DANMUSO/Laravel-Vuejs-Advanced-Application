<template>
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Client Location Component</div>

                    <div class="card-body">
                       <GmapMap
  :center="{lat:1.2921, lng:36.8219}"
  :zoom="7"
  map-type-id="terrain"
  style="width: 100%; height: 400px"
>
  <GmapMarker
    :key="index"
    v-for="(m, index) in markers"
    :position="m.position"
    :clickable="true"
    :draggable="true"
    @click="center=m.position"
  />
</GmapMap>
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
              markers:[]
            };
        },
        methods: {

        }
    }
</script>
