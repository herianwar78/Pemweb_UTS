@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.beasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.beasiswas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="beasiswaname">{{ trans('cruds.beasiswa.fields.beasiswaname') }}</label>
                <input class="form-control {{ $errors->has('beasiswaname') ? 'is-invalid' : '' }}" type="text" name="beasiswaname" id="beasiswaname" value="{{ old('beasiswaname', '') }}" required>
                @if($errors->has('beasiswaname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beasiswaname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.beasiswaname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nim">{{ trans('cruds.beasiswa.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', '') }}" required>
                @if($errors->has('nim'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nim') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jurusan">{{ trans('cruds.beasiswa.fields.jurusan') }}</label>
                <input class="form-control {{ $errors->has('jurusan') ? 'is-invalid' : '' }}" type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', '') }}" required>
                @if($errors->has('jurusan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jurusan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection