<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-group"></i> Autenticacion</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon fa fa-user"></i> <span>Usuarios</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon fa fa-group"></i> <span>Roles</span></a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('producto') }}'><i class='nav-icon la la-question'></i> Productos</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('venta') }}'><i class='nav-icon la la-question'></i> Ventas</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('proveedor') }}'><i class='nav-icon la la-question'></i> Proveedor</a></li>
