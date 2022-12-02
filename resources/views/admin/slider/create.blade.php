@extends('layouts.admin')

@section('content')

<style>
    .btn {
        color: white
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Thêm Sliders
                    <a href="{{ url('admin/sliders') }}" class="btn btn-secondary btn-sm text-white float-end">Trở về</a>
                </h3>
            </div>

            <div class="card-body">
                {{-- @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif --}}
                <form action="{{ url('admin/sliders') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                        @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label><br/>
                        <input type="checkbox" name="status" style="width: 30px; height: 30px"/>
                        <p>Checked=Hidden, Unchecked=Visible</p>
                        @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Lưu</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection