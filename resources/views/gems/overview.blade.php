@extends('layouts.app')

@section('content')

<div class="row">
    <a href="/gems/create" class="m-4 btn btn-dark">Neuen Edelstein anlegen</a>
</div>
<form method="POST">
    {{ csrf_field() }}
    <div class="card-group">
        <div class="card">
            <div class="card-header">Kategorien</div>
            <div class="card-body">
                @foreach($gem_categories as $gem_category)
                    <div><label>
                        <input type="checkbox"
                               name="categories[{{ $gem_category->id }}]"
                               value="{{ $gem_category->id }}"
                               @if(request('categories')[$gem_category->id] ?? false) checked="checked" @endif> {{$gem_category->name}}
                    </label></div>
                @endforeach
                <button class="btn btn-dark" type="submit">Filtern</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Edelsteine</div>
            <div class="card-body">
                @if(!count($gems))
                    Nichts gefunden
                @endif
                @foreach($gems as $id => $name)
                    <div><a href="/gems/{{ $id }}/edit">{{$name}}</a></div>
                @endforeach
            </div>
        </div>
    </div>
</form>
@endsection
