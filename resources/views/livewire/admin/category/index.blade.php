<style>
    .btn {
        color: #ffffff;
    }
</style>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <h6 class="alert alert-success">{{ session('message') }}</h6>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>
                    Danh mục
                    <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end">Thêm danh mục</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="60%">Name</th>
                            <th width="10%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->status=='1'?'Hidden':'Visible' }}</td>
                            <td>
                                <a href="{{ url('admin/category/'.$item->id.'/edit') }}" class="btn btn-success">Sửa</a>
                                <a href="{{ url('admin/category/'.$item->id.'/delete') }}" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này không?')" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('script')
@endpush
