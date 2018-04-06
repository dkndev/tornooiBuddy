@extends('base')

@section('content')

    <div id="map" style="width: 100% ; height: 400px;"></div>
    <h1>test</h1>

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
@endsection