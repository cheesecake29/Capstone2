<style>
    .navs {
        padding: 3%;
        background-color: #0062CC;
        width: 100%;
        overflow-y: auto;
    }

    a.nav-links {
        padding: 3%;
    }

    .nav-item a.nav-links {
        color: #ffff !important;
        background-color: #0062CC;
        padding: 3%;

    }

    .nav {
        width: 100%;
        margin-bottom: 5%;

    }


    .side {
        background-color: #0062CC !important;
        width: 100%;
        overflow-y: auto;
    }

    .nav-item a.nav-links:hover {
        background-color: #FFFF;
        color: #0062CC !important;
        border-radius: 0 10px 10px 0;
        padding: 3%;
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main main-sidebar elevation-4 sidebar-no-expand gb-bs-body-bg-r">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-primary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.6rem;height: 1.6rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('sys_shortname') ?></span>
    </a>
    <!-- Sidebar -->

    <div class="side sidebar os-host  os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition">
        <!-- ... (other sidebar elements) -->

        <!-- Sidebar Menu -->

        <nav class="nav mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

                <li class="navs nav-item">
                    <a href="./" class="nav-links nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($_settings->userdata('type') == 1) : ?>
                    <li class="navs nav-item">
                        <a href="<?php echo base_url ?>admin/?page=shop_config" class="nav-links nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Shop Configuration</p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="navs nav-item">
                    <a href="<?php echo base_url ?>admin/?page=inventory/order_config" class="nav-links nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Price Configuration</p>
                    </a>
                </li>


                <li class="navs nav-item">
                    <a href="#" class="nav-links nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Content Management</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=content_management/home" class="nav-links nav-link nav-content_management_home">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>

                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=content_management/services" class=" nav-links nav-link nav-content_management_services">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>Services</p>
                            </a>
                        </li>
                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=content_management/contactus" class=" nav-links nav-link nav-content_management_contactus">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Contact Us</p>
                            </a>
                        </li>

                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=content_management/logo" class=" nav-links nav-link nav-content_management_logo">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Logo</p>
                            </a>



                    </ul>
                </li>
                <li class="navs nav-item">
                    <a href="#" class="nav-links nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Stock Management</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="navs nav-item">

                            <a href="<?php echo base_url ?>admin/?page=inventory" class=" nav-links nav-link nav-inventory">
                                <i class="nav-icon fas fa-table"></i>
                                <p>Inventory</p>
                            </a>
                        </li>
                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=products" class="nav-links nav-link nav-products">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>Product List</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="navs nav-item">
                    <a href="#" class="nav-links nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Client Services</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_settings->userdata('type') == 1) : ?>
                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=shop_calendar" class="nav-links nav-link nav-clients">
                                    <i class="nav-icon fas fa-calendar"></i>
                                    <p>Calendar</p>
                                </a>
                            </li>
                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=orders" class="nav-links nav-link nav-clients">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>Orders</p>
                                </a>
                            </li>



                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=clients" class="nav-links nav-link nav-clients">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Registered Clients</p>
                                </a>
                            </li>

                        <?php endif; ?>

                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=clients/inquiries" class="nav-links nav-link nav-clients_inquiries">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Customer Inquiries</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="navs nav-item">
                    <a href="#" class="nav-links nav-link">
                        <i class="nav-icon fas fa-chart-pie report-logo"></i>
                        <p>Reports</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="navs nav-item">
                            <a href="<?php echo base_url ?>admin/?page=report/orders" class="nav-links nav-link nav-report_orders">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Orders Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if ($_settings->userdata('type') == 1) : ?>
                    <li class="navs nav-item has-treeview">
                        <a href="#" class="nav-links nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Maintenance</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/brands" class="nav-links nav-link nav-maintenance_brands">
                                    <i class="fas fa-star nav-icon"></i>

                                    <p>Brand List</p>
                                </a>
                            </li>
                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/category" class="nav-links nav-link nav-maintenance_category">
                                    <i class="fas fa-folder nav-icon"></i>
                                    <p>Category List</p>
                                </a>
                            </li>
                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/services" class="nav-links nav-link nav-maintenance_services">
                                    <i class="fas fa-wrench nav-icon"></i>

                                    <p>Service List</p>
                                </a>
                            </li>

                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=maintenance/supplier" class="nav-links nav-link nav-maintenance_supplier">
                                    <i class="fas fa-wrench nav-icon"></i>

                                    <p>Supplier List</p>
                                </a>
                            </li>
                            <li class="navs nav-item">
                                <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-links nav-link nav-user_list">
                                    <i class="fas fa-users nav-icon"></i>

                                    <p>Roles Management</p>
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

            // Restore menu state when the page loads
            restoreMenuState();

            // Handle submenu clicks to store their state
            $('.nav-item.has-treeview > a').on('click', function(e) {
                e.preventDefault();
                var menuId = $(this).attr('href');
                $(menuId).toggleClass('menu-open');
                storeMenuState();
            });
        }
    })
</script>