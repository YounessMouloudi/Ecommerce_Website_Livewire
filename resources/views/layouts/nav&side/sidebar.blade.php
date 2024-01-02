<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav text-capitalize">
      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active':'' }}">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('admin/orders*') ? 'active':'' }}">
        <a class="nav-link" href="{{route('all_orders')}}">
          <i class="mdi mdi-sale menu-icon"></i>
          <span class="menu-title">orders</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('admin/categories*') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#categories" 
        aria-expanded="{{ Request::is('admin/categories*') ? 'true':'false' }}">
          <i class="mdi mdi-view-list menu-icon"></i>
          <span class="menu-title">categories</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/categories*') ? 'show':'' }}" id="categories">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/categories/create*') ? 'active':'' }}" href="{{route('add_categorie')}}">add categorie</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/categories') || Request::is('admin/categories/*/edit') ? 'active':'' }}" href="{{route('cat')}}">view categorie</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ Request::is('admin/products*') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#products" 
          aria-expanded="{{ Request::is('admin/products*') ? 'true':'false' }}">
          <i class="mdi mdi-plus-circle menu-icon"></i>
          <span class="menu-title">products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/products*') ? 'show':'' }}" id="products">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products/create') ? 'active':'' }}" href="{{route('add_product')}}">add product</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products') || Request::is('admin/products/*/edit')? 'active':'' }}" href="{{route('products')}}">view product</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ Request::is('admin/brands') ? 'active':'' }}">
        <a class="nav-link" href="{{route('brand')}}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">brands</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('admin/colors') ? 'active':'' }}">
        <a class="nav-link" href="{{route('colors')}}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">colors</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('admin/users*') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#users" 
          aria-expanded="{{ Request::is('admin/users*') ? 'true':'false' }}">
          <i class="mdi mdi-account-multiple-plus menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/users*') ? 'show':'' }}" id="users">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/users/create*') ? 'active':'' }}" href="{{route('add_user')}}"> add user </a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') ? 'active':'' }}" href="{{route('users')}}"> view user </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ Request::is('admin/sliders') ? 'active':'' }}">
        <a class="nav-link" href="{{route('sliders')}}">
          <i class="mdi mdi-view-carousel menu-icon"></i>
          <span class="menu-title">sliders</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('admin/settings') ? 'active':'' }}">
        <a class="nav-link" href="{{route('settings')}}">
          {{-- <i class="mdi mdi-emoticon menu-icon"></i> --}}
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">setting</span>
        </a>
      </li>
    </ul>
</nav>
