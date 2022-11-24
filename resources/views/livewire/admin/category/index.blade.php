<style>
    .btn {
        color: #ffffff;
    }
</style>
<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa danh mục</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" wire:submit.prevent="destroyCategory">

                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa danh mục này không
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </form>
          </div>
        </div>
      </div>

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
                                <a href="#deleteModal" wire:click="deleteCategory({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa</a>
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
<script>
    window.addEventListener('close-modal', event=>{

        $('#deleteModal').modal('hide');
    })
</script>
@endpush
