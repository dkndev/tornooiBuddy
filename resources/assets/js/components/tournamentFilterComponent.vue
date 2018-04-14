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
            <button v-on:click="getCoordinatesFromPostcode">tset</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "tournament-filter-component",
                user: {},
                tournaments: {},
                filters: {
                    date: {
                        start: null,
                        end: null
                    },
                    location: {
                        postcode: 3040,
                        coordinates: {
                            lat: 51.02,
                            lon: 4.03
                        },
                        distance: 300
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
            calculatNewRange: function () {
                console.log('range');
                const r_earth = 6378.1;
                this.maxRange.maxLat = this.filters.location.coordinates.lat + (this.filters.location.distance / r_earth) * (180 / Math.PI);
                this.maxRange.maxLon = this.filters.location.coordinates.lon + (this.filters.location.distance / r_earth) * (180 / Math.PI) / Math.cos(this.filters.location.coordinates.lat * Math.PI / 180);
                this.maxRange.minLat = this.filters.location.coordinates.lat + (-this.filters.location.distance / r_earth) * (180 / Math.PI);
                this.maxRange.minLon = this.filters.location.coordinates.lon + (-this.filters.location.distance / r_earth) * (180 / Math.PI) / Math.cos(this.filters.location.coordinates.lat * Math.PI / 180);
            },
            getCoordinatesFromPostcode: function () {
                console.log('axios');
                axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                    responseType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'x-apikey': 'AIzaSyDJVBNuK_VEtQunQQvcOnfISPTUgnKtXkc',
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET',
                        'Access-Control-Expose-Headers': 'Access-Control-Allow-Origin'
                    },
                    params: {
                        key: "AIzaSyDJVBNuK_VEtQunQQvcOnfISPTUgnKtXkc",
                        sensor: true,
                        address: 'BE ' + this.filters.location.postcode
                    }
                })
                    .then(response => {
                        console.log(response);
                        this.test = response;
                    })
                    .catch(function (error) {
                        console.log(error);
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
                this.calculatNewRange();
            }
        },
        mounted: function () {
            // this.getCoordinatesFromPostcode();
        }
    }
</script>

<style scoped>

</style>

