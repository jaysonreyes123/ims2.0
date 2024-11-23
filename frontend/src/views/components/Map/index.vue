<template>
    <div class="shadow-lg">
        <MapboxMap
                style="height:350px"
                access-token="pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw"
                map-style="mapbox://styles/mapbox/streets-v11"
                :center="[122.4902841093123,12.573067659271082]"
                :zoom="4"
                @mb-click="clickMap"
                >
                <MapboxMarker :lng-lat="coordinates_()" />
        </MapboxMap>
    </div>

  </template>
  <script>
  import { MapboxMap, MapboxMarker } from '@studiometa/vue-mapbox-gl';
  import Card from "@/components/Card";
  import 'mapbox-gl/dist/mapbox-gl.css';
  export default { 
      props:{
        set_coordinates:{
            type:String,
            default:""
        }
      },
      components:{
          MapboxMap,
          MapboxMarker,
          Card,
      },
      data(){
        return{
            map:null,
            coordinates:[0,0],
        }
      },
      methods:{
        clickMap(event){
            const {lng,lat} = event.lngLat;
            this.coordinates=[lng,lat];
            this.$emit("updateCoordinate",event.lngLat)
        },
        coordinates_(){     
            if( this.set_coordinates == ""  || this.set_coordinates == null ){
                return [0,0];
            }   
            const set_coordinates_ = this.set_coordinates.split(',');
            return set_coordinates_;
        }
      }
  }
  </script>