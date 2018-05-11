import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import TournamentFilter from '../components/tournamentFilterComponent'
import TournamentPost from '../components/TournamentPostComponent'
import {EventBus} from '../my-vues/eventBus'
import Loader from 'vue-spinner/src/clipLoader.vue'

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
Vue.component('loader', Loader);

const vue = new Vue({
    el: '#vueApp',
    data: {
        center: {
            lat: 50.83,
            lng: 4.36
        },
        markers: [],
        hoverMsg: {
            text: '',
            id: null
        },
        tournaments: [],
        color: "#c52b20",
        size: '100px',
        loading: false
    },
    computed: {

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
                obj.id = e.id;
                this.markers.push(obj);
            })
        },
        setHoverMsg: function (m) {
            this.hoverMsg.text = m.text;
            this.hoverMsg.id = m.id
        }
    },
    mounted: function () {
        EventBus.$on('TournamentPosts', (payLoad) => {
            this.tournaments = payLoad;
            this.newMarkers();
        });
        EventBus.$on('Loading', (payLoad) => {
            this.loading = payLoad;
        });
    }
});