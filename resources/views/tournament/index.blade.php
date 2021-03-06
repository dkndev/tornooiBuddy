@extends('base')

@section('content')



    <div class="loader" style="position: absolute; top: 50vh; left: 35vw; z-index: 1000;">
        <loader :loading="loading" :color="color" :size="size"></loader>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
            <google-map :center="center" :zoom="8" style="width: 100%; min-height: 400px; height: 100%;">
                <google-marker :key="m.index" v-for="m in markers" :position="m.position" :clickable="true"
                               :draggable="false" @click="center=m.position" @mouseover="setHoverMsg(m)"
                               @mouseout=""></google-marker>
                <div slot="visible">
                    <div id="hoverMsgWapper" class="text-center">
                        <a :href="'tournaments/' + hoverMsg.id">@{{hoverMsg.text}}</a>
                    </div>
                </div>
            </google-map>
        </div>
        <tournament-filter :user="{{$user}}" :ranking="{{$user_ranking}}"></tournament-filter>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
            <tournament-post v-for="t in tournaments" :key="t.index" :title="t.name" :start="t.date.start"
                             :end="t.date.end"
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