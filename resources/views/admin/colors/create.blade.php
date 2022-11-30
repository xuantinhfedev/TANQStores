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
                    Thêm màu sắc
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
                <form action="{{ url('admin/colors') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Color name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="code">Color code</label>
                        <input type="text" name="code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label><br/>
                        <input type="checkbox" name="status" style="width: 30px; height: 30px"/> Checked=Hidden, Unchecked=Visible
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
