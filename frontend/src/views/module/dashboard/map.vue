<template>
    <div class="shadow-lg">
        <Card title="Incident Map">
                    <div class="lg:grid grid-cols-1 rounded-md">
                        <div class="col-span-4">
                        <MapboxMap
                        class="h-screen"
                        @mb-created="(mapInstance) => map = mapInstance"
                        access-token="pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw"
                        map-style="mapbox://styles/mapbox/streets-v11"
                        :center="[122.4902841093123,12.573067659271082]"
                        :zoom="5"
                        >
                        <MapboxGeocoder 
                        countries="PH"
                        />
        
                        <MapboxMarker v-if="incident_map_ !== undefined" v-for="(item,index) in incident_map_.features " :key="index" :lng-lat="item.geometry.coordinates">
                            <template v-slot:popup>
                                <div style="width: 300px">
                                    <p class="text-base"><b>Incident</b></p>
                                    <div class="text-xs mt-1">
                                        <router-link class="text-blue-600" :to="`/app/module/incidents/detail/${item.properties.id}`">
                                            {{ item.properties.incident_no }}
                                        </router-link>
                                        <p><b>Status: </b>{{ item.properties.status }}</p>
                                        <p><b>Location: </b>{{ item.properties.location }}</p>
                                    </div>
                                </div>
                            </template>
                            <p class="custom-marker">
                            <span class="pulsing-dot-red"></span>
                            </p>
                        </MapboxMarker>
        
                        <MapboxMarker v-if="resources_map_ !== undefined" v-for="(item,index) in resources_map_.features " :key="index" :lng-lat="item.geometry.coordinates">
                            <template v-slot:popup>
                                <div style="width: 300px">
                                    <p class="text-base"><b>Resources</b></p>
                                    <div class="text-xs mt-1">
                                        <router-link class="text-blue-600" :to="`/app/module/resources/detail/${item.properties.id}`">
                                            {{ item.properties.name }}
                                        </router-link>
                                        <p><b>Type: </b>{{ item.properties.type }}</p>
                                        <p><b>Status: </b>{{ item.properties.status }}</p>
                                    </div>
                                </div>
                            </template>
                            <p class="custom-marker">
                            <span class="pulsing-dot-black"></span>
                            </p>
                        </MapboxMarker>
                        </MapboxMap>
                    </div>
            </div>
        </Card>
  
    </div>
  
  </template>
  <script>
  import { MapboxMap, MapboxMarker,MapboxGeocoder,MapboxImages,MapboxLayer   } from '@studiometa/vue-mapbox-gl';
  import Card from "@/components/Card";
  import '@mapbox/mapbox-gl-geocoder/lib/mapbox-gl-geocoder.css';
  import 'mapbox-gl/dist/mapbox-gl.css';
  import { ref } from 'vue';
  const map = ref();
  const incident_map_ = ref([]);
  const resources_map_ = ref([]);
  export default { 
      components:{
          MapboxMap,
          MapboxMarker,
          MapboxGeocoder,
          MapboxImages,
          MapboxLayer,
          Card,
  
      },
      data(){
        return{
            coordinates:[0,0],
            incident_map_,
            resources_map_,
            map
  
        }
      },
      mounted(){
        this.incident_map();
        this.resources_map();
      },
      methods:{
        async incident_map(){
            try {
                const response = await this.$axios.get("map/incidents");
                this.incident_map_ = response.data;
            } catch (error) {
                console.log(error)
            }
        },
        async resources_map(){
            try {
                const response = await this.$axios.get("map/resources");
                this.resources_map_ = response.data;
            } catch (error) {
                console.log(error)
            }
        },
        flyto(coordinates){
            map.value.flyTo({
                center:coordinates
            })
        }
      },
  }
  </script>
  <style>
  .legend-container{
    position: absolute;
    right: 25px;
    top: 70px;
    background: white;
    border-radius: 5px;
    height: 100vh;
    width: 210px;
    z-index: 999;
  }
  .pulsing-dot-red {
    background: red;
    border-radius: 100%;
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid white;
    box-shadow: 0 0 0 0 rgba(255, 0, 0, 1);
    animation: pulse_red 1.4s infinite;
  }
  
  .pulsing-dot-black {
    background: black;
    border-radius: 100%;
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid white;
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
    animation: pulse_black 1.5s infinite;
  }
  
  @keyframes pulse_red {
    0% {
        transform: scale(0.80);
        box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.8);
    }
  
    70% {
        transform: scale(1);
        box-shadow: 0 0 0 15px rgba(255, 0, 0, 0);
    }
  
    100% {
        transform: scale(0.80);
        box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
    }
  }
  
  @keyframes pulse_black {
    0% {
        transform: scale(0.80);
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.8);
    }
  
    70% {
        transform: scale(1);
        box-shadow: 0 0 0 15px rgba(0, 0, 0, 0);
    }
  
    100% {
        transform: scale(0.80);
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
    }
  }
  </style>