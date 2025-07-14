@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Media</h4>

    <form action="{{ route('media.update', $medium->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ $medium->judul }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>File (Kosongkan jika tidak ingin mengganti)</label>
            <input type="file" name="file" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
