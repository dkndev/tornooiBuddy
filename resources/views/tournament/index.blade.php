@extends('base')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
            <google-map :center="center" :zoom="8" style="width: 100%; min-height: 400px; height: 100%;">
                <google-marker :key="m.index" v-for="m in markers" :position="m.position" :clickable="true"
                               :draggable="false" @click="center=m.position" @mouseover="statusText = m.text"
                               @mouseout=""></google-marker>
                <div slot="visible">
                    <div style="bottom: 0; left: 0; background-color: #343a40; color: white; position: absolute; z-index: 100">
                        @{{statusText}}
                    </div>
                </div>
            </google-map>
        </div>
        <tournament-filter></tournament-filter>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
            <tournament-post v-for="t in tournaments" :key="t.index" :title="t.name" :start="t.date.start" :end="t.date.end"
                             :address="t.location.address" :contact="t.contact"></tournament-post>
        </div>
    </div>

    {{--@foreach($tournaments as $t)--}}
        {{--<h4><a href="{{route('tournaments.show',['id'=> $t->id])}}">{{$t->name}}</a></h4>--}}
        {{--<p>tornooi id: {{$t->id}}</p>--}}
        {{--<span>tornooi start: {{$t->date_start}}</span>--}}
        {{--<span>tornooi end: {{$t->date_end}}</span>--}}
        {{--<p>tornooi location: {{$t->location->address}}</p>--}}
        {{--<p>tornooi contact: {{$t->contact->name}}</p>--}}
        {{--<span>tornooi type: {{$t->type->type}}</span>--}}

        {{--@foreach($t->rankings as $rank)--}}
            {{--<button class="btn btn-primary">{{$rank->rank}}</button>--}}
        {{--@endforeach--}}
        {{--<hr>--}}
    {{--@endforeach--}}

@endsection

@section('script')
    <script src="{{ asset('/js/vue/tournamentsVue.js') }}"></script>
@endsection