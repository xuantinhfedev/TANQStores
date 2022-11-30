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
                    Sửa màu sắc
                    <a href="{{ url('admin/colors') }}" class="btn btn-secondary btn-sm text-white float-end">Trở về</a>
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
                <form action="{{ url('admin/colors/'.$color->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Color name</label>
                        <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="code">Color code</label>
                        <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label><br/>
                        <input type="checkbox" name="status" {{ $color->status?'checked':'' }} style="width: 30px; height: 30px"/> Checked=Hidden, Unchecked=Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
