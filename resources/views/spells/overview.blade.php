@extends('layouts.app')

@section('content')
    <div class="row">
        <a href="/spells/create" class="m-4 btn btn-dark">Neuen Spruch anlegen</a>
    </div>
    <form method="POST">
        {{ csrf_field() }}
        <div class="card-group">

            <div class="card">
                <div class="card-header">Klassen</div>
                <div class="card-body">
                    @foreach($charClasses as $charClass)
                        <div><label><input type="checkbox"
                                           name="classes[{{ $charClass->identifier }}]"
                                           value="{{ $charClass->identifier }}"
                                           @if(request('classes')[$charClass->identifier] ?? false) checked="checked" @endif> {{$charClass->name}}
                            </label></div>
                    @endforeach
                    <button class="btn btn-dark" type="submit">Filtern</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Schulen</div>
                <div class="card-body">
                    @foreach($schools as $school)
                        <div><label><input type="checkbox"
                                           name="schools[{{ $school->id }}]"
                                           value="{{ $school->id }}"
                                           @if(request('schools')[$school->id] ?? false) checked="checked" @endif> {{$school->name}}
                            </label></div>
                    @endforeach
                    <button class="btn btn-dark" type="submit">Filtern</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Grade</div>
                <div class="card-body">
                    @foreach($ranks as $id => $rank)
                        <div><label><input type="checkbox"
                                           name="ranks[{{ $id }}]"
                                           value="{{$id}}"
                                           @if(isset(request('ranks')[$id]) ) checked="checked" @endif> {{$rank}}
                            </label></div>
                    @endforeach
                    <button class="btn btn-dark" type="submit">Filtern</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Sprüche</div>
                <div class="card-body">
                    @if(!count($spells))
                        Nichts gefunden
                    @endif
                    @foreach($spells as $id => $name)
                        <div><a href="/spells/{{ $id }}/edit">{{$name}}</a></div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection
