@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Charaktere</div>
                    <ul class="list-group list-group-flush">
                        @foreach($characters as $c)
                            <li class="list-group-item">
                                <a href="{{ route('character.edit', ['id' => $c['id']]) }}"
                                   class="btn btn-light">{{ $c['name'] }} </a>
                                <a href="{{ route('character.delete', ['id' => $c['id']]) }}" class="btn btn-danger">Löschen</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer">
                        <a href="{{ route('character.edit') }}" class="btn btn-dark">Neuer  Charakter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
