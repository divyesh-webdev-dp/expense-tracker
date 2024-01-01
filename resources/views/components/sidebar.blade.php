 <!-- Sidebar Start -->
 <aside class="left-sidebar">
     <!-- Sidebar scroll-->
     <div>
         <div class="brand-logo d-flex align-items-center justify-content-between">
             <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                 <img src="{{ asset('images/logos/png/logo-no-background.png') }}" width="180" alt="" />
             </a>
             <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                 <i class="ti ti-x fs-8"></i>
             </div>
         </div>
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
             <ul id="sidebarnav">
                 <x-nav-item route="{{ route('dashboard') }}" icon="ti-layout-dashboard" name="Dashboard" />
                 <x-nav-item-heading name="Transaction Management" />
                 <x-nav-item route="#" icon="ti-currency-rupee" name="Transaction" />
                 <x-nav-item route="#" icon="ti-category" name="Category" />
                 <x-nav-item route="#" icon="ti-tag" name="Tag" />
                 <x-nav-item-heading name="Budgeting" />
                 <x-nav-item route="#" icon="ti-businessplan" name="Budget" />
                 <x-nav-item-heading name="User Settings" />
                 <x-nav-item route="#" icon="ti-settings" name="Settings" />
                 <x-nav-item route="#" icon="ti-user-circle" name="Profile" />
                 <x-nav-item-heading name="Support and Help" />
                 <x-nav-item route="#" icon="ti-help" name="Help & Support" />
             </ul>
         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>
 <!--  Sidebar End -->
