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
            lat: 50.84,
            lng: 4.36
        },
        markers: [],
        statusText: ''
    // TODO statusText omzeten naar url link
    },
    methods: {
        getTournaments: function () {
            console.log('axios tournaments');
            axios.get('http://tornooibuddy.local/api/tournaments/', {
                responseType: 'json',
            })
                .then(response => {
                    let data = response.data.data;
                    data.forEach((e) => {
                        let obj = {};
                        obj.position = {};
                        obj.position.lat = e.location.latitude;
                        obj.position.lng = e.location.longitude;
                        obj.text = ' '.repeat(15) + e.name;
                        this.markers.push(obj);
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });

        }
    },
    mounted: function () {
        this.getTournaments();
    }
});