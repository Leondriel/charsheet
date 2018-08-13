@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Sprüche des {{ $rank }}. Grades</div>
        <div class="card-body">
            <form method="post" action="/spells/saveRelation/{{ $rank }}">
                {{ csrf_field() }}
                <table class="table-sm table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Barde</th>
                        <th>Kleriker</th>
                        <th>Druide</th>
                        <th>Paladin</th>
                        <th>Waldläufer</th>
                        <th>Zauberer</th>
                        <th>Hexenmeister</th>
                        <th>Magier</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($spells as $spell)
                        <tr>
                            <td>{{ $spell->name }}</td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][bard]" {{ $spell->list_bard ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][cleric]" {{ $spell->list_cleric ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][druid]" {{ $spell->list_druid ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][paladin]" {{ $spell->list_paladin ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][ranger]" {{ $spell->list_ranger ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][sorcerer]" {{ $spell->list_sorcerer ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][warlock]" {{ $spell->list_warlock ? "checked":"" }}></td>
                            <td><input type="checkbox"
                                       class="form-control"
                                       value="1"
                                       name="relations[{{ $spell->id }}][wizard]" {{ $spell->list_wizard ? "checked":"" }}></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Speichern</button>
            </form>
        </div>
    </div>
@endsection
