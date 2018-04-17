<template>
    <div class="address-map fluid h-100 uk-position-relative" v-if="name">
        <div class="p-1 uk-text-meta" v-show="loading">
            Checking...
        </div>

        <div class="google-map" :id="mapName" :style="{height : mapHeight + 'px'}"></div>
    </div>
</template>
<style scoped>
    .google-map {
      width: 100%;
      height: 100%;
      margin: 0 auto;
    }
</style>
<script type="text/babel">

    export default{
        data(){
            return{
                mapName: this.name + "-map"
            }
        },
        name: 'google-map',
        props: ['name', 'markers', 'height', 'loading'],
        mounted: function () {
            this.initMap();
        },
        methods : {
            initMap(){
                if(this.markers && _.isArray(this.markers) && this.markers.length){
                    const element = document.getElementById(this.mapName);
                    const location = this.markers[0];

                    if(!location.latitude || !location.longitude) return;

                    const options = {
                        zoom: 14,
                        center: new window.google.maps.LatLng(location.latitude, location.longitude)
                    }
                    const map = new window.google.maps.Map(element, options);

                    this.markers.forEach((coord) => {
                        const position = new window.google.maps.LatLng(coord.latitude, coord.longitude);
                        const marker = new window.google.maps.Marker({
                            position,
                            map
                        });
                    });
                }
            }
        },
        watch : {
            markers : function () {
                this.initMap();
            }
        },
        computed : {
            mapHeight : function () {
                return this.height ? this.height : 300;
            }
        }
    }
</script>
