@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
            <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>
                    Sửa sản phẩm
                    <a href="{{ url('admin/products/') }}" class="btn btn-secondary btn-sm text-white float-end">Trở về</a>
                </h3>
            </div>

            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>

                @endif

                <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">SEO tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Product Image</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" >Product Colors</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="mb-3">
                                <label>
                                    Chọn danh mục
                                </label>
                                <select name="category_id" class="form-select">
                                    <option value="">--- Chọn danh mục ---</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected':'' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" value="{{ $product->slug }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Chọn thương hiệu</label>
                                <select name="brand" class="form-select">
                                    @foreach ($brands as $item)
                                        <option value="{{ $item->name }}" {{ $item->name == $product->brand ? 'selected':'' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Small Description(500 words)</label>
                                <textarea name="small_description" rows="4" class="form-control">
                                    {{ $product->small_description }}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="4" class="form-control">
                                    {{ $product->description }}
                                </textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value=" {{ $product->meta_title }}">
                            </div>
                            <div class="mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" rows="4" class="form-control">
                                    {{ $product->meta_description }}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" rows="4" class="form-control">
                                    {{ $product->meta_keyword }}
                                </textarea>
                            </div>

                        </div>
                        <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Giá gốc</label>
                                        <input type="text" name="original_price" class="form-control" value="{{ $product->original_price }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Giá bán</label>
                                        <input type="text" name="selling_price" class="form-control" value="{{ $product->selling_price }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Số lượng</label>
                                        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending" style="width: 50px; height: 50px;"
                                        {{ $product->trending=='1'?'checked':'' }}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" style="width: 50px; height: 50px;"
                                        {{ $product->status=='1'?'checked':'' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Thêm mới ảnh sản phẩm</label>
                                <input type="file" name="image[]" multiple class="form-control"/>
                            </div>
                            <div>
                                @if($product->productImages)
                                <div class="row">
                                    @foreach ($product->productImages as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset($image->image) }}" style="width: 120px; height: 120px"
                                        class="me-4 border" alt="Image">
                                        <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="btn btn-danger d-block mt-8" style="width: 120px; margin-top: 8px">Xóa</a>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                    <h5>Không có hình ảnh được thêm vào</h5>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" tabindex="0">
                            <div class="mb-3">
                                <h4>Thêm màu sắc sản phẩm</h4>
                                <label>Chọn màu sắc</label>
                                <hr>
                                <div class="row">
                                    @forelse ($colors as $colorItem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-4">
                                            Color: <input type="checkbox" name="colors[{{ $colorItem->id }}]" value="{{ $colorItem->id }}" /> {{ $colorItem->name }}
                                            <br/>
                                            Quantity: <input type="number" name="colorQuantity[{{ $colorItem->id }}]" style="width: 70px; border: 1px solid"/>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="col-md-12">
                                            <h1>Không tìm thấy màu nào</h1>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        <hr/>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Color Name</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productColors as $prodColor)
                                        <tr class="prod-color-tr">
                                            <td>
                                                @if($prodColor->color)
                                                    {{ $prodColor->color->name }}
                                                @else
                                                    Không tìm thấy màu nào
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mb-3" style="width: 150px">
                                                    <input type="text" value="{{ $prodColor->quantity }}" class="productColorQuantity form-control form-control-sm">
                                                    <button class="updateProductColorBtn btn btn-primary btn-sm text-white" type="button" value="{{ $prodColor->id }}">Cập nhật</button>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="deleteProductColorBtn btn btn-danger btn-sm text-white" type="button" value="{{ $prodColor->id }}">Xóa</button>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary text-white float-end mt-3" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click','.updateProductColorBtn', function () {

            var product_id = "{{ $product->id }}"
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
            // alert(prod_color_id);

            if(qty <= 0) {
                alert('Số lượng bắt buộc > 0');
                return false;
            }
            var data = {
                'product_id': product_id,
                'qty': qty
            }
            console.log(data);
            $.ajax({
                type: "POST",
                url: "/admin/product-color/"+prod_color_id,
                data: data,
                success: function (response) {
                    alert(response.message);
                  }
            });

        });

        $(document).on('click','.deleteProductColorBtn' , function () {
            var prod_color_id = $(this).val();
            var thisClick = $(this);

            $.ajax({
                type: "GET",
                url: "/admin/product-color/"+prod_color_id+"/delete",
                success: function (response) {
                    thisClick.closest('.pro-color-tr').remove();
                    alert(response.message);
                }
            });
        });
    });
</script>

@endsection
