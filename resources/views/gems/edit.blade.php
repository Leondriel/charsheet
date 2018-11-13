@extends('layouts.app')

@section('content')
<div class="card gem">
    <div class="card-body">
        <form method="POST" action="/gems{{ $gem->id?('/' . $gem->id):''}}">
            {{ csrf_field() }}
            @if($gem->id)
                {{ method_field('PUT') }}
            @endif
            <div class="form-group row">
                <label for="gemName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="gemName"
                           placeholder="Name"
                           name="name"
                           value="{{ $gem->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="gemCategory" class="col-sm-2 col-form-label">Kategorie</label>
                <div class="col-sm-10">
                    <select id="gemCategory" class="form-control" name="gem_category_id">
                        @foreach($gem_categories as $id => $gem_category)
                            <option {{ ($id == $gem->gem_category_id)?'selected':'' }} value="{{ $id }}">{{ $gem_category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="gemCost" class="col-sm-2 col-form-label">Wert</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="gemCost"
                           placeholder="Wert"
                           name="cost"
                           value="{{ $gem->cost }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="gemDescription" class="col-sm-2 col-form-label">Beschreibung</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="gemDescription" rows="10">{{ $gem->description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Speichern</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
