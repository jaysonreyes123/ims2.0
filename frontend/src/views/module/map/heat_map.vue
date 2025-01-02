<template>
  <div class="shadow-lg">
    <div ref="mapContainer" class="map-container h-screen"></div>
  </div>
  
</template>

<script>
  import mapboxgl from 'mapbox-gl';
  import { ref } from 'vue';
  mapboxgl.accessToken ="pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw";
  const heat_map_data = ref([]);
  export default {
    data(){
      return{
        heat_map_data
      }
    },
    mounted(){
      this.heat_map();
    },
    methods:{
      async heat_map(){
          try {
              const response = await this.$axios.get("map/heat_map");
              this.heat_map_data = response.data;
              const map = new mapboxgl.Map({
              container: this.$refs.mapContainer,
              style: 'mapbox://styles/mapbox/dark-v10',
              center: [122.4902841093123,12.573067659271082],
              zoom:5
            });
            map.addControl(new mapboxgl.FullscreenControl());
            map.addControl(new mapboxgl.NavigationControl());
            map.on('load',()=>{
            map.addSource('datasource', { type: 'geojson', data: this.heat_map_data });
            console.log(this.heat_map_data)
            map.addLayer({
                          'id': 'heatheat',
                          'type': 'heatmap',
                          'source': 'datasource',
                          'maxzoom': 10,
                          'paint': {
                              // increase weight as diameter breast height increases
                              'heatmap-weight': {
                                  'property': 'dbh',
                                  'type': 'exponential',
                                  'stops': [
                                      [1, 0],
                                      [62, 1]
                                  ]
                              },
                              // increase intensity as zoom level increases
                              'heatmap-intensity': {
                                  'stops': [
                                      [11, 1],
                                      [18, 3]
                                  ]
                              },
                              // use sequential color palette to use exponentially as the weight increases
                              'heatmap-color': [
                                  'interpolate',
                                  ['linear'],
                                  ['heatmap-density'],
                                  0, 'rgba(255, 255, 255,0)',
                                  0.2, '#FF0000',
                                  0.4, '#FF0000',
                                  0.6, '#FF0000',
                                  0.8, '#FF0000'
                              ],
                              // increase radius as zoom increases
                              'heatmap-radius': {
                                  'stops': [
                                      [3, 18],
                                      [10, 20]
                                  ]
                              },
                              // decrease opacity to transition into the circle layer
                              'heatmap-opacity': {
                                  'default': 1,
                                  'stops': [
                                      [6, 1],
                                      [10, 0]
                                  ]
                              }
                          }
                      },
                      'waterway-label'
                  );  

                  map.addLayer({
                    'id': 'point',
                    'type': 'circle',
                    'source': 'datasource',
                    'minzoom': 9,
                    'paint': {
                        // increase the radius of the circle as the zoom level and dbh value increases
                        'circle-radius': {
                            'property': 'dbh',
                            'type': 'exponential',
                            'stops': [
                                [{ zoom: 10, value: 1 }, 5],
                                [{ zoom: 10, value: 62 }, 10],
                                [{ zoom: 12, value: 1 }, 20],
                                [{ zoom: 12, value: 62 }, 50]
                            ]
                        },
                        'circle-color': {
                            'property': 'dbh',
                            'type': 'exponential',
                            'stops': [
                                [0, 'rgba(255, 255, 255,0)'],
                                [10, '#FF0000'],
                                [20, '#FF0000'],
                                [30, '#FF0000'],
                                [40, '#FF0000'],
                                [50, '#FF0000'],
                                [60, '#FF0000']
                            ]
                        },
                        'circle-stroke-color': 'white',
                        'circle-stroke-width': 1,
                        'circle-opacity': {
                            'stops': [
                                [6, 0],
                                [10, 1]
                            ]
                        }
                    }
                },
                'waterway-label'
            );
            })
          } catch (error) {
              console.log(error)
          }
      },
    }
  };
</script>

<style>
</style>