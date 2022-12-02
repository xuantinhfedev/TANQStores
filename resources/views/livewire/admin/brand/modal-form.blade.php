<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
            <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeBrand">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-1">Category</label>
                    <select wire:model.defer="category_id" required class="form-control">
                        <option value="">--Chọn danh mục--</option>
                        @foreach ($categories as $cateItem)
                             <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                        @endforeach
                       
                        
                    </select>
                    @error('category_id')<small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Brands Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')<small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Brands Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')<small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <input type="checkbox" wire:model.defer="status"/>
                    <p>Checked=Hidden, Un-checked=Visible</p>
                    @error('status')<small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- UPDATE BRANDS MODAL -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brands</h1>
            <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div wire:loading.remove>
        <form wire:submit.prevent="updateBrand">
            <div class="modal-body">
            <div class="mb-3">
                    <label class="mb-1">Category</label>
                    <select wire:model.defer="category_id" required class="form-control">
                        <option value="">--Chọn danh mục--</option>
                        @foreach ($categories as $cateItem)
                             <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                        @endforeach
                       
                        
                    </select>
                    @error('category_id')<small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Brands Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')<small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Brands Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')<small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <input type="checkbox" wire:model.defer="status" style="width:12px; height:12px;"/>
                    <p>Checked=Hidden, Un-checked=Visible</p>
                    @error('status')<small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

<!-- DELETE BRANDS MODAL -->

<!-- UPDATE BRANDS MODAL -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brands</h1>
            <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div wire:loading.remove>
        <form wire:submit.prevent="destroyBrand">
            <div class="modal-body">
                <h4>Bạn có chắc muốn xóa thương hiệu này không?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>