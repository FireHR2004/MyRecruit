@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Scoring for {{ $alternatif->nama_alternatif }}</h1>
    <form action="{{ route('scoring.update', $alternatif->id) }}" method="POST">
        @csrf
        @method('PUT')
        @foreach($kriterias as $kriteria)
            <div class="mb-3">
                <label for="kriteria_{{ $kriteria->id }}" class="form-label"> {{ $kriteria->nama_kriteria }}</label>
                <select class="form-select" id="kriteria_{{ $kriteria->id }}" name="kriteria[{{ $kriteria->id }}]">
                    @foreach($subKriterias->where('kriteria_id', $kriteria->id) as $subKriteria)
                        <option value="{{ $subKriteria->id }}" {{ $subKriteria->id == optional($alternatif->scorings->where('kriteria_id', $kriteria->id)->first())->sub_kriteria_id ? 'selected' : '' }}>
                            {{ $subKriteria->nama_sub_kriteria }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
