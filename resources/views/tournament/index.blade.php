@extends('base')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-9">
            <google-map :center="center" :zoom="7" style="width: 100%; height: 400px">
                <google-marker :key="m.index" v-for="m in markers" :position="m.position" :clickable="true" :draggable="false" @click="center=m.position"></google-marker>
            </google-map>
        </div>
        <tournament-filter></tournament-filter>
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
    <script src="{{ asset('/js/vue/tournamentsVue.js') }}"></script>
@endsection