import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import TournamentFilter from '../components/tournamentFilterComponent'
import TournamentPost from '../components/TournamentPostComponent'
import {EventBus} from '../my-vues/eventBus';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDJVBNuK_VEtQunQQvcOnfISPTUgnKtXkc',
        // libraries: 'places', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)
    }
});

Vue.component('google-map', VueGoogleMaps.Map);
Vue.component('google-marker', VueGoogleMaps.Marker);
Vue.component('tournament-filter', TournamentFilter);
Vue.component('tournament-post', TournamentPost);

const vue = new Vue({
    el: '#vueApp',
    data: {
        center: {
            lat: 50.83,
            lng: 4.36
        },
        markers: [],
        statusText: '',
        tournaments: []
        // TODO statusText omzeten naar url link
    },
    methods: {
        newMarkers: function () {
            let data = this.tournaments;
            this.markers = [];
            data.forEach((e) => {
                let obj = {};
                obj.position = {};
                obj.position.lat = e.location.latitude;
                obj.position.lng = e.location.longitude;
                obj.text = e.name;
                this.markers.push(obj);
            })
        }
    },
    mounted: function () {
        EventBus.$on('TournamentPosts', (payLoad) => {
            this.tournaments = payLoad;
            this.newMarkers();
        });
    }
});