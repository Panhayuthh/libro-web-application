<div class="sidebar border-end">
  <div class="sidebar-header border-bottom">
    <div class="sidebar-brand sidbar">Libro</div>
  </div>
  <ul class="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="nav-icon cil-home"></i> Home
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('menu') ? 'active' : '' }}" href="{{ route('menu') }}">
        <i class="nav-icon cil-list"></i> Menu
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('order') ? 'active' : '' }}" href="{{ route('order') }}">
        <i class="nav-icon cil-cart"></i> Order
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('history') ? 'active' : '' }}" href="{{ route('history') }}">
        <i class="nav-icon cil-history"></i> History
      </a>
    </li>
  </ul>
  <div class="sidebar-footer border-top d-flex">
    <button class="sidebar-toggler" type="button"></button>
  </div>
</div>