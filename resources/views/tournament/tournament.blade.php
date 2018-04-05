@extends('base')

@section('content')

    <h1>test</h1>


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


@endsection