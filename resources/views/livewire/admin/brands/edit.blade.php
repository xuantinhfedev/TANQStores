<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update post</div>
                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" wire:model="name" class="form-control" id="name" placeholder="Enter a name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" wire:model="slug" class="form-control" id="slug" placeholder="Enter a slug">
                                @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label><br/>
                                <input type="checkbox" name="status" {{ $brand->status == '1'?'checked':'' }}>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{route('admin.brands.index')}}" class="btn btn-danger">Trở về</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
