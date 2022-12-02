<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/forms/basic_elements.html">
          <i class="mdi mdi-sale menu-icon"></i>
          <span class="menu-title">Sales</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-category" aria-expanded="false" aria-controls="ui-basic-category">
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
          <span class="menu-title">Danh mục</span>
          <i class="menu-arrow"></i>
        </a>

        <div class="collapse" id="ui-basic-category">
          <ul class="nav flex-column sub-menu" >
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/category/create") }}">Thêm danh mục</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/category") }}">Xem danh mục</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-product" aria-expanded="false" aria-controls="ui-basic-product">
          <i class="mdi mdi-plus-circle menu-icon"></i>
          <span class="menu-title">Sản phẩm</span>
          <i class="menu-arrow"></i>
        </a>

        <div class="collapse" id="ui-basic-product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/products/create") }}">Thêm sản phẩm</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/products") }}">Xem sản phẩm</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/brands">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Thương hiệu</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/colors">
          <i class="mdi mdi-border-color menu-icon"></i>
          <span class="menu-title">Màu sắc</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/sliders')}}">
          <i class="mdi mdi-view-carousel menu-icon"></i>
          <span class="menu-title">Home Slider</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="pages/charts/chartjs.html">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">Charts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/tables/basic-table.html">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Tables</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Icons</span>
        </a>
      </li>
    </ul>
  </nav>
