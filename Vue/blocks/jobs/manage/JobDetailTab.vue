<template>
    <div class="row" v-if="job">
        <div class="col-sm-6">
            <div class="mb-3 mt-0">
              <span v-for="category in job.categories" class="d-inline-block mr-3">
                 <i class="tag icon"></i>
                 {{ category.name }}
              </span>
            </div>

            <p class="mail-desc fluid d-block mb-5" v-html="job.description"></p>

            <span class="time pull-right uk-text-middle">
                <i class="icon clock large "></i>
                {{ job.publishedOn.diff }}
            </span>

            <a :href="'/jobs/' + job.slug" target="_blank" class="ui label mini inverse">
                <i class="icon unhide"></i> Preview
            </a>
        </div>
        <div class="col-sm-5 offset-1">
            <google-map :name="job.id"
                        :height="350"
                        :markers="[{latitude: job.location.latitude,
                                        longitude: job.location.longitude}]">
            </google-map>
        </div>
    </div>
</template>
<style scoped>

</style>
<script type="text/babel">

    export default{
        data(){
            return{

            }
        },
        props : ['job'],
        components : {
        	'google-map' : require('../../../blocks/shared/GoogleMap.vue')
        }

    }
</script>
