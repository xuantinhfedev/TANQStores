<style>
    .btn {
        color: #ffffff;
    }
    h3 {
        margin: 0;
        line-height: 1.5rem;
    }
    .card-header{
        display: flex;
        justify-content: space-between;
    }
</style>
<div>
      @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Thương hiệu
                        </h3>
                        <a href="{{route('admin.brands.create')}}" class="btn btn-primary btn-sm float-end"> Thêm  thương hiệu </a>
                    </div>
                    <div class="card-body">
                     <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" scope="col">ID</th>
                                    <th width="50%" scope="col">Name</th>
                                    {{-- <th width="10%" scope="col">Slug</th> --}}
                                    <th width="20%" scope="col">Status</th>
                                    <th width="20%" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    {{-- <td>{{$item->slug}}</td> --}}
                                    <td>{{ $item->status=='1'?'Hidden':'Visible' }}</td>

                                    <td>
                                        <a href="{{route('admin.brands.edit', $item->id)}}" class="btn btn-sm btn-success"> Sửa </a>
                                        <button type="button" onclick="deleteBrand({{$item->id}})" class="btn btn-sm btn-danger">Xóa</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">No posts found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$brands->links()}}
                    </div>
                </div>
            </div>
        </div>
    <script>
     function deleteBrand(id) {
        if (confirm("Are you sure to delete this record?"))
            Livewire.emit('deleteBrand', id);
     }
    </script>
</div>
