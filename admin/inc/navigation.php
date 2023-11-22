<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-no-expand -bs-body-bg-rgb">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-primary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.6rem;height: 1.6rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('sys_shortname') ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition">
        <!-- ... (other sidebar elements) -->
        <!-- Sidebar Menu -->
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Content Management</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=content_management/front-end" class="nav-link nav-content_management_front-end">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>User Interface</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="<?php echo base_url ?>admin/?page=content_management/front-end/home" class="nav-link nav-content_management_front-end_home">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>Home</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url ?>admin/?page=content_management/front-end/services" class="nav-link nav-content_management_front-end_services">
                                        <i class="nav-icon fas fa-handshake"></i>
                                        <p>Services</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url ?>admin/?page=content_management/front-end/contactus" class="nav-link nav-content_management_front-end_contactus">
                                        <i class="nav-icon fas fa-envelope"></i>
                                        <p>Contact Us</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url ?>admin/?page=content_management/front-end/aboutus" class="nav-link nav-content_management_front-end_aboutus">
                                        <i class="nav-icon fas fa-info-circle"></i>
                                        <p>About Us</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url ?>admin/?page=content_management/front-end/logo" class="nav-link nav-content_management_front-end_logo">
                                        <i class="nav-icon fas fa-envelope"></i>
                                        <p>Logo</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=content_management/back-end" class="nav-link nav-content_management_back-end">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Back-End</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Stock Management</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=inventory" class="nav-link nav-inventory">
                                <i class="nav-icon fas fa-table"></i>
                                <p>Inventory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=products" class="nav-link nav-products">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>Product List</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-cc-visa"></i>
                        <p>Payments</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=payments/gcash" class="nav-link nav-payments_gcash">
                                <i class="nav-icon  fab fa-google-wallet"></i>
                                <p>Gcash</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=payments/COD" class="nav-link nav-payments_COD">
                                <i class="nav-icon  fas fa-money-bill-wave"></i>
                                <p>Cash on delivery</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Client Services</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=orders" class="nav-link nav-orders">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=service_requests" class="nav-link nav-service_requests">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Service Requests</p>
                            </a>
                        </li>
                        <!--  <li class="nav-item">
                    <a href="<?php echo base_url ?>admin/?page=mechanics" class="nav-link nav-mechanics">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Mechanic List</p>
                    </a>
                </li>
                --->
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=clients" class="nav-link nav-clients">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Registered Clients</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie report-logo"></i>
                        <p>Reports</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=report/service_requests" class="nav-link nav-report_service_requests">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Service Requests Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url ?>admin/?page=report/orders" class="nav-link nav-report_orders">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Orders Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if ($_settings->userdata('type') == 1) : ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Maintenance</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/brands" class="nav-link nav-maintenance_brands">
                                    <i class="fas fa-star nav-icon"></i>

                                    <p>Brand List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/category" class="nav-link nav-maintenance_category">
                                    <i class="fas fa-folder nav-icon"></i>
                                    <p>Category List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/services" class="nav-link nav-maintenance_services">
                                    <i class="fas fa-wrench nav-icon"></i>

                                    <p>Service List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/supplier" class="nav-link nav-maintenance_supplier">
                                    <i class="fas fa-wrench nav-icon"></i>

                                    <p>Supplier List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                                    <i class="fas fa-users nav-icon"></i>

                                    <p>User List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                                    <i class="fas fa-cogs nav-icon"></i>
                                    <p>Settings</p>
                                </a>
                            </li>


                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
        <!-- Sidebar Scrollbar -->
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- JavaScript for Sidebar Behavior -->
<script>
    $(document).ready(function() {
        // Function to store the menu state in local storage
        function storeMenuState() {
            var menuState = {};

            $('.nav-item.has-treeview').each(function() {
                var menuId = $(this).find('a').attr('href');
                var isOpen = $(this).hasClass('menu-open');
                menuState[menuId] = isOpen;
            });

            localStorage.setItem('menuState', JSON.stringify(menuState));
        }

        // Function to restore the menu state from local storage
        function restoreMenuState() {
            var menuState = JSON.parse(localStorage.getItem('menuState')) || {};

            for (var menuId in menuState) {
                if (menuState[menuId]) {
                    $(menuId).addClass('menu-open');
                }
            }
        }

        // Restore menu state when the page loads
        restoreMenuState();

        // Handle submenu clicks to store their state
        $('.nav-item.has-treeview > a').on('click', function(e) {
            e.preventDefault();
            var menuId = $(this).attr('href');
            $(menuId).toggleClass('menu-open');
            storeMenuState();
        });
    });
</script>