<template>
  <div>
      <div id="map2">
      </div>
      <div id="popup-div2">
          <div  style="width: 250px;max-height: 500px">
          <div id="table-popup2"></div>
      </div>
  </div>
  </div>    
</template>

<script>
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";
import { onMounted } from "vue";
import wl from "../../../assets/images/map/water.png";
import {useDashboardStore} from '@/store/dashboard';
const dashboard = useDashboardStore();
export default {
  props:{
      wlmap_data:{
        type:Object
      }
  },
  setup(props) {
    onMounted(() => {
      mapboxgl.accessToken = "pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw";
      const map = new mapboxgl.Map({
        container: "map2",
        style: "mapbox://styles/mapbox/outdoors-v12",
        center: [122.86575348304838,12.632834332230221],
        zoom:4
      });

      if(props.wlmap_data.features === undefined){
      return;
  }
     props.wlmap_data.features.map(item=>{
   
          if(item.geometry.coordinates.length >= 2){

              const div = document.createElement('div');
              const width = "30";
              const height = "30";
              div.className = 'marker';
              div.style.background = `${item.properties.color}`;
              div.style.width = `${width}px`;
              div.style.height = `${height}px`;
           

              let table_popup = document.getElementById('popup-div2');
              div.addEventListener('mousemove', (e) => {
                  let x = e.pageX+20;
                  let y = e.pageY;
                  div.style.cursor = "pointer";
                  table_popup.innerHTML = item.properties.table;
                  table_popup.style.left = x+"px";
                  table_popup.style.top = y+"px";
                  table_popup.style.display = "block";
              });

              div.addEventListener('mouseout', (e) => {
                  let divs = document.getElementById('popup-div2');
                  divs.style.display = 'none';
                  table_popup.innerHTML = "";
              });

              new mapboxgl.Marker(div)
              .setLngLat(item.geometry.coordinates)
              .addTo(map);
          }
     })
    });
  },
};
</script>

<style>
#map2 {
  position: relative;
  height: 300px;
}
.mapboxgl-ctrl-logo,.mapboxgl-ctrl{
  display: none !important;
}
#popup-div2{
  position: absolute;
  display: block;
  z-index: 99999999;
  background: white;
  padding: 10px 20px;
}
</style>