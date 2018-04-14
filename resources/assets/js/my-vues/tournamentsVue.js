import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import TournamentFilter from '../components/tournamentFilterComponent'

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

const vue = new Vue({
    el: '#vueApp',
    data: {
        center: {
            lat: 10.0,
            lng: 10.0
        },
        markers: [{
            position: {
                lat: 10.0,
                lng: 10.0
            }
        }, {
            position: {
                lat: 11.0,
                lng: 11.0
            }
        }]
    },
    methods:{

    }
});