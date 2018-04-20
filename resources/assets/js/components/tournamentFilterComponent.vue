<template>
    <div class="col-12 col-md-4 col-lg-3">
        <div class="card pl-2 pr-2">
            <h3>filter</h3>
            <form action="">
                <h4>Datum</h4>
                <div class="form-group">
                    <label for="date_start">Van</label>
                    <input id="date_start" class="form-control" type="date" v-model="filters.date.start">
                </div>
                <div class="form-group">
                    <label for="date_end">Tot</label>
                    <input id="date_end" class="form-control" type="date" v-model="filters.date.end">
                </div>

                <hr>

                <h4>Locatie</h4>
                <div class="form-row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="postCode">Postcode</label>
                            <input id="postCode" class="form-control" type="number" min="1000" max="9999"
                                   v-model="filters.location.postcode">
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="afstand">Afstand</label>
                            <input id="afstand" class="form-control" type="number"
                                   v-model="filters.location.distance">
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Klassementen</h4>
                <div class="form-check form-check-inline">
                    <input id="check-A" class="form-check-input" type="checkbox">
                    <label for="check-A" class="form-check-label">A</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="check-B1" class="form-check-input" type="checkbox">
                    <label for="check-B1" class="form-check-label">B1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="check-B2" class="form-check-input" type="checkbox">
                    <label for="check-B2" class="form-check-label">B2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="check-C1" class="form-check-input" type="checkbox">
                    <label for="check-C1" class="form-check-label">C1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="check-C2" class="form-check-input" type="checkbox">
                    <label for="check-C2" class="form-check-label">C2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="check-D" class="form-check-input" type="checkbox">
                    <label for="check-D" class="form-check-label">D</label>
                </div>
            </form>
            <button v-on:click="getTournaments">filter</button>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../my-vues/eventBus';
    export default {
        props: ['user','ranking'],
        data() {
            return {
                name: "tournament-filter-component",
                tournaments: {},
                filters: {
                    date: {
                        start: "",
                        end: ""
                    },
                    location: {
                        postcode: null,
                        coordinates: {
                            lat: null,
                            lon: null
                        },
                        distance: 50
                    }
                },
                maxRange: {
                    maxLat: null,
                    minLat: null,
                    maxLon: null,
                    minLon: null
                },
                test: ''
            }
        },
        methods: {
            setUser:function () {
              this.filters.location.postcode = this.user[0].location.postcode;
              this.filters.location.coordinates.lat = this.user[0].location.latitude;
              this.filters.location.coordinates.lon = this.user[0].location.longitude;
            },
            makeDate: function () {
                let today = "";
                let oneYear = "";
                let d = new Date();
                let month = (d.getMonth() > 10 ? (d.getMonth()+1) : '0' + (d.getMonth()+1));
                let day = (d.getDate() > 10 ? d.getDate() : '0' + d.getDate());
                today = d.getFullYear() + '-' + month + '-' + day;
                oneYear = d.getFullYear()+1 + '-' + month + '-' + day;
                this.filters.date.start = today;
                this.filters.date.end = oneYear;
            },
            calculatNewRange: function () {
                console.log('range');
                const r_earth = 6378.1;
                this.maxRange.maxLat = this.filters.location.coordinates.lat + (this.filters.location.distance / r_earth) * (180 / Math.PI);
                this.maxRange.maxLon = this.filters.location.coordinates.lon + (this.filters.location.distance / r_earth) * (180 / Math.PI) / Math.cos(this.filters.location.coordinates.lat * Math.PI / 180);
                this.maxRange.minLat = this.filters.location.coordinates.lat + (-this.filters.location.distance / r_earth) * (180 / Math.PI);
                this.maxRange.minLon = this.filters.location.coordinates.lon + (-this.filters.location.distance / r_earth) * (180 / Math.PI) / Math.cos(this.filters.location.coordinates.lat * Math.PI / 180);
            },
            getCoordinatesFromPostcode: function () {
                let postcode = this.filters.location.postcode;
                if (postcode.length === 4) {
                    console.log('axios postcode');
                    axios.get('/api/postcode/' + postcode, {
                        responseType: 'json',
                    })
                        .then(response => {
                            console.log(response);
                            this.test = response.data;
                            let data = response.data;
                            this.filters.location.coordinates.lat = data.latitude;
                            this.filters.location.coordinates.lon = data.longitude;

                            this.calculatNewRange();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            getTournaments: function () {
                axios({
                    method: 'post',
                    url:'/api/tournaments/',
                    responseType: 'json',
                    data:{
                        filter: {
                            location:{
                                max:{
                                    lat: this.maxRange.maxLat,
                                    lon: this.maxRange.maxLon
                                },
                                min:{
                                    lat: this.maxRange.minLat,
                                    lon: this.maxRange.minLon
                                }
                            },
                            date:{
                                start: this.filters.date.start,
                                end:this.filters.date.end,
                            }
                        }
                    }
                }).then((response) => {
                    this.tournaments = response.data.data;
                    EventBus.$emit('TournamentPosts', this.tournaments);
                });
            },
            getAllTournaments: function () {
                console.log("axios all tournaments");
                axios({
                    method: 'get',
                    url:'/api/tournaments/',
                    responseType: 'json',
                }).then((response) => {
                    this.tournaments = response.data.data;
                    EventBus.$emit('TournamentPosts', this.tournaments);
                });
            }
        },
        watch: {
            test: function (val, oldVal) {
                console.log('new: %s, old: %s', val, oldVal)
            },
            'filters.location.distance': function (val, oldVal) {
                this.calculatNewRange();
            },
            'filters.location.postcode': function (val, oldVal) {
                this.getCoordinatesFromPostcode();
            }
        },
        mounted: function () {
            this.setUser();
            this.calculatNewRange();
            this.makeDate();
            this.getAllTournaments();
        }
    }
</script>

<style scoped>

</style>

