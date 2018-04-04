@extends('base')

@section('content')

    <h1>test</h1>

    @foreach($tournaments as $t)
        <p>tornooi id: {{$t->id}}</p>
        <p>tornooi start: {{$t->date_start}}</p>
        <p>tornooi end: {{$t->date_end}}</p>
        <p>tornooi id: {{$t->id}}</p>
        <p>tornooi location: {{$t->location->adress}}</p>
        <p>tornooi contact: {{$t->contact->name}}</p>
        <p>tornooi type: {{$t->type->type}}</p>

        <hr>
    @endforeach

@endsection