@extends('base')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
            <div id="map" style="width: 100% ; height: 400px;"></div>
        </div>
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
            </div>
        </div>
    </div>
    <h1>toernooien</h1>

    @foreach($tournaments as $t)
        <h4><a href="{{route('tournaments.show',['id'=> $t->id])}}">{{$t->name}}</a></h4>
        <p>tornooi id: {{$t->id}}</p>
        <span>tornooi start: {{$t->date_start}}</span>
        <span>tornooi end: {{$t->date_end}}</span>
        <p>tornooi location: {{$t->location->address}}</p>
        <p>tornooi contact: {{$t->contact->name}}</p>
        <span>tornooi type: {{$t->type->type}}</span>

        @foreach($t->rankings as $rank)
            <button class="btn btn-primary">{{$rank->rank}}</button>
        @endforeach
        <hr>
    @endforeach

@endsection

@section('script')

    <script type="text/javascript">
        var locations = [
                @foreach($tournaments as $t)
            ['<a href="{{route('tournaments.show',['id' => $t->id])}}">{{$t->name}}</a>', {{$t->location->latitude}}, {{$t->location->longitude}}],
            @endforeach
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: new google.maps.LatLng(50.85, 4.35),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    </script>


    <script>
        const vue = new Vue({
            el: '#vueApp',
            data: {
                user: {},
                tournaments: {},
                filters: {
                    date: {
                        start: null,
                        end: null
                    },
                    location: {
                        postcode: null,
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
            },
            methods: {
                calculatNewRange:function () {
                    const r_earth = 6378.1;
                    this.maxRange.maxLat  = this.filters.location.coordinates.lat  + (this.filters.location.distance / r_earth) * (180 / Math.PI);
                    this.maxRange.maxLon = this.filters.location.coordinates.lon + (this.filters.location.distance / r_earth) * (180 / Math.PI) / Math.cos(this.filters.location.coordinates.lat * Math.PI/180);
                    this.maxRange.minLat  = this.filters.location.coordinates.lat  + (-this.filters.location.distance / r_earth) * (180 / Math.PI);
                    this.maxRange.minLon = this.filters.location.coordinates.lon + (-this.filters.location.distance / r_earth) * (180 / Math.PI) / Math.cos(this.filters.location.coordinates.lat * Math.PI/180);
                }
            },
            computed: {},
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
            }
        });
    </script>
@endsection