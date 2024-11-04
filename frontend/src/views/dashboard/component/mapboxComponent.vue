<template>
    <div>
        <Card>
            <MapboxMap
                style="height: calc(100vh - 250px);"
                access-token="pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw"
                map-style="mapbox://styles/mapbox/streets-v11"
                :center="[125.49165724379682,9.789201201576544]" 
                :zoom="10">
                <template v-if="map_.length > 0">
                    <MapboxMarker v-for="(item,i) in map_" :key="i" :lng-lat="item.data.coordinate" popup>
                        <template v-slot:popup>
                            <div v-html="item.data.table"></div>
                        </template>
                    </MapboxMarker>     
                </template>
            </MapboxMap>
        </Card>
    </div>

  </template>
  <script>
  import { MapboxMap, MapboxMarker } from '@studiometa/vue-mapbox-gl';
  import Card from "@/components/Card";
  import 'mapbox-gl/dist/mapbox-gl.css';
  export default {
      props:{
        map_:Object
      },   
      components:{
          MapboxMap,
          MapboxMarker,
          Card
      }
  }
  </script>
  <style scoped>
</style>
  