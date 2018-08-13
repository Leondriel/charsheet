@extends('layouts.app')

@section('content')
    <div class="card spell">
        <div class="card-body">
            <form method="POST" action="/spells{{ $spell->id?('/' . $spell->id):''}}">
                {{ csrf_field() }}
                @if($spell->id)
                    {{ method_field('PUT') }}
                @endif
                <div class="form-group row">
                    <label for="spellName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control"
                               id="spellName"
                               placeholder="Name"
                               name="name"
                               value="{{ $spell->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spellSchool" class="col-sm-2 col-form-label">Schule</label>
                    <div class="col-sm-10">
                        <select id="spellSchool" class="form-control" name="school_id">
                            @foreach($schools as $id => $school)
                                <option {{ ($id == $spell->school_id)?'selected':'' }} value="{{ $id }}">{{ $school }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spellRank" class="col-sm-2 col-form-label">Grad</label>
                    <div class="col-sm-10">
                        <select id="spellRank" class="form-control" name="rank">
                            @foreach([0,1,2,3,4,5,6,7,8,9] as $rank)
                                <option {{ ($rank == $spell->rank)?'selected':'' }} value="{{ $rank }}">{{ $rank }}.
                                    Grad
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spellCastDuration" class="col-sm-2 col-form-label">Zeitaufwand</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control"
                               id="spellCastDuration"
                               placeholder="Zeitaufwand"
                               name="cast_duration"
                               value="{{ $spell->cast_duration }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spellRange" class="col-sm-2 col-form-label">Reichweite</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control"
                               id="spellRange"
                               placeholder="Reichweite"
                               name="range"
                               value="{{ $spell->range }}">
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-legend col-sm-2">Komponenten</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="component_voice"
                                           id="spellComponentVoice"
                                           value="1" {{ $spell->component_voice?'checked':'' }}>
                                    Verbal
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="component_gesture"
                                           id="spellComponentGesture"
                                           value="1" {{ $spell->component_gesture?'checked':'' }}>
                                    Gesten
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="component_material"
                                           id="spellComponentMaterial"
                                           value="1" {{ $spell->component_material?'checked':'' }}>
                                    Material: <input class="form-control"
                                                     style="width:500px;"
                                                     type="text"
                                                     name="material"
                                                     value="{{ $spell->material }}">
                                </label>
                            </div>

                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="spellDuration" class="col-sm-2 col-form-label">Wirkungsdauer</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control"
                               id="spellDuration"
                               placeholder="Wirkungsdauer"
                               name="duration"
                               value="{{ $spell->duration }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spellDescription" class="col-sm-2 col-form-label">Beschreibung</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="spellDescription" rows="10">{{ $spell->description }}</textarea>
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
