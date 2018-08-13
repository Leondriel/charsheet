@extends('layouts.app')

@section('content')
    <charsheet :c="{{ json_encode($c, JSON_OBJECT_AS_ARRAY) }}"
               :spells="{{ json_encode($spells, JSON_OBJECT_AS_ARRAY) }}"
               :races="{{ json_encode($races) }}"
               :classes="{{ json_encode($classes) }}"
               :alignments="{{ json_encode($alignments) }}"
               :schools="{{ json_encode($schools) }}"
               :user="{{ json_encode($user) }}"></charsheet>
@endsection
