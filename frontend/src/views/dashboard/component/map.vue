<template>
    <div>
        <Card>
            <div class="md:flex items-center">
                <div class="flex-1" style="position: relative;">
                    <div id="map"></div>
                    <div id="state-legend" class="legend">
                    <div><span style="background-color: gray"></span>Inactive</div>
                    <div><span style="background-color: rgb(16, 176, 83)"></span>Active</div>
                    </div>
                </div>
            </div>
        </Card>
        <div id="popup-div" style="display: none;padding: 0px;">
            <div  style="width: 250px;max-height: 500px">
            <div id="table-popup"></div>
        </div>
    </div>
    </div>    
  </template>
  
<script setup>
  import Card from "@/components/Card";
  import mapboxgl from "mapbox-gl";
  import "mapbox-gl/dist/mapbox-gl.css";
  import { onMounted,watch,ref } from "vue";

  const props = defineProps(['map_data']);
  onMounted(()=>{
    mapboxgl.accessToken = "pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw";
    const map = new mapboxgl.Map({
      container: "map",
      style: "mapbox://styles/mapbox/streets-v11",
      center: [125.49975764039635,9.759641160924716], 
    zoom:8
    });

    map.on('load',()=>{
      // map.loadImage(
      //   'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
      //   (error, image) => {
      //     console.log(image)
      //     if (error) throw error;
      //     map.addImage('map-icon',image);
          map.addSource('fms-map',props.map_data);
          map.addLayer({
            id:"map-id",
            type:"symbol",
            source:"fms-map",
            layout:{
              'icon-image':'map-icon',
              'icon-allow-overlap': true,
              'icon-size':0.60,
              'text-field':['get','station'],
              'text-font': [
                  'Open Sans Semibold',
                  'Arial Unicode MS Bold'
              ],
              'text-size':12,
              'text-offset': [0, 0],
              'text-anchor': 'top',
              'icon-allow-overlap': true,
              'text-allow-overlap': true,
            }
          });

          const coordinates_ = props.map_data.data.features;
          coordinates_.map((item,index)=>{
            new mapboxgl.Marker({
              color:item.properties.color
            })
            .setLngLat(item.geometry.coordinates)
            .addTo(map);
          })
          const popup = new mapboxgl.Popup({
            closeButton: false,
            closeOnClick: false
          });
          
          map.on('mouseenter','map-id',(e)=>{
            map.getCanvas().style.cursor='pointer';
            const coordinates = e.features[0].geometry.coordinates;
            const table = e.features[0].properties.table;
            popup.setLngLat(coordinates).setHTML(table).addTo(map);
          })
          map.on('mouseleave','map-id' ,()=>{
            map.getCanvas().style.cursor='';
            popup.remove();
          })
    //     }
    //   )
     })
  })

</script>

  <!-- <script>
  import Card from "@/components/Card";
  import mapboxgl from "mapbox-gl";
  import "mapbox-gl/dist/mapbox-gl.css";
  import { onMounted } from "vue";
  import rgiamge from "../../../assets/images/map/cloud.png";
  export default {
    components:{
        Card
    },
    props:{
        map_data:{
          type:Object
        }
    },
    setup(props) {
      onMounted(() => {
     
        mapboxgl.accessToken = "pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw";
        const map = new mapboxgl.Map({
          container: "map",
          style: "mapbox://styles/mapbox/outdoors-v12",
          center: [125.49975764039635,9.759641160924716], 
          zoom:8
        });
  
    if(props.map_data.features === undefined){
        return false;
    }
       props.map_data.features.map(item=>{
  
            if(item.geometry.coordinates.length >= 2){
  
                const div = document.createElement('div');
                const width = "30";
                const height = "30";
                div.className = 'marker';
                div.style.background = `red`;
                div.style.width = `${width}px`;
                div.style.height = `${height}px`;
            
  
                let table_popup = document.getElementById('popup-div');
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
                    let divs = document.getElementById('popup-div');
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
  </script> -->
  
  <style>
  #map {
    position: relative;
    height: 775px !important;
  }
  .mapboxgl-ctrl-logo,.mapboxgl-ctrl{
    display: none !important;
  }
  #popup-div{
    position: absolute;
    display: block;
    z-index: 99999999;
    background: white;
    padding: 10px 20px;
  }
  .legend {
        background-color: #fff;
        border-radius: 3px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        font:
            12px/20px 'Helvetica Neue',
            Arial,
            Helvetica,
            sans-serif;
        padding: 10px;
        position: absolute;
        right: 10px;
        top: 10px;
        height: auto;
        z-index: 1;
    }

    .legend h4 {
        margin: 0 0 10px;
        font-size: 50px;
    }

    .legend div span {
        border-radius: 50%;
        display: inline-block;
        height: 10px;
        margin-right: 5px;
        width: 10px;
    }
  </style>
  