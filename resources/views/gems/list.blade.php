@extends('layouts.app')

@section('content')
    <?php $i = 0; $rank = -1; ?>
    @foreach($spells as $spell)
        @if($rank != $spell->rank)
            <?php $rank = $spell->rank; $i = 0; ?>
            <div style="clear:both; width:100%"><h1>{{ $rank }}. Grad</h1></div>
        @endif
        <?php $i++; ?>
        <div style="float:left; width: 600px;">
            <spell
                    :spell="{{ json_encode($spell->toArray()) }}"
                    :schools="{{ json_encode($schools) }}"></spell>
        </div>
        @if(!($i % 3))
            <div style="clear:both; width:100%">
                <hr>
            </div>
        @endif
    @endforeach
@endsection
