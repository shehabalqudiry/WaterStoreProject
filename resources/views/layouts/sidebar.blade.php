<div class="sidebar">

    <div class="logo-header">
        <a href="#" class="logo">
            لوحة التحكم
        </a>

    </div>
    <div class="scrollbar-inner sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ request()->is('*/admin') ? 'active' : '' }}">
                <a href="/admin">
                    <i class="la la-angle-double-left "></i>
                    <p>الرئيسية</p>
                </a>
            </li>
            <li class="nav-item {{ request()->is('*/sliders') ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>إدارة السلايدير</p>

                </a>
            </li>
            <li class="nav-item {{ request()->is('*/offers') ? 'active' : '' }}">
                <a href="{{ route('admin.offers.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>إدارة العروض</p>

                </a>
            </li>
            <li class="nav-item {{ request()->is('*/coupons') ? 'active' : '' }}">
                <a href="{{ route('admin.coupons.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>إدارة كوبونات الخصم</p>

                </a>
            </li>
            {{-- <li class="nav-item {{ request()->is('*/mosques') ? 'active' : '' }}">
                <a href="{{ route('admin.mosques.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>إدارة المساجد</p>

                </a>
            </li> --}}
            <li class="nav-item {{ request()->is('*/users') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>إدارة المستخدمين</p>

                </a>
            </li>
            <li class="nav-item {{ request()->is('*/companies') ? 'active' : '' }}">
                <a href="{{ route('admin.companies.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>إدارة الشركات</p>

                </a>
            </li>

            <li class="nav-item {{ request()->is('*/product') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>ادارة المنتجات</p>
                </a>
            </li>
            <li class="nav-item {{ request()->is('*/orders') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>ادارة الطلبات</p>
                </a>
            </li>
            <li class="nav-item {{ request()->is('*/companies') ? 'active' : '' }}">
                <a href="{{ route('admin.contacts.index') }}">
                    <i class="la la-angle-double-left "></i>
                    <p>تواصل معنا</p>

                </a>
            </li>
            <li class="nav-item {{ request()->is('*/settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}">
                    <i class="la la-angle-double-left"></i>
                    <p>الأعدادات</p>

                </a>
            </li>
        </ul>
    </div>
</div>
