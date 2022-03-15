<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link  :to="{ name : 'Home' }" class="brand-link">
        <img :src="$config.logo" :alt="$config.name" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $config.name }}</span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 d-flex">
                <div class="image">
                <img :src="$config.user_image" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <nav-item name="Dashboard" icon="fas fa-tachometer-alt" :route="['Home']" />
                    <nav-treeview name="Pages" icon="fas fa-file-alt" :route="['About','Blank']">
                        <nav-item name="About" :route="['About']" />
                        <nav-item name="Blank Page" :route="['Blank']" />
                    </nav-treeview>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
import NavItem from "./NavItem.vue";
import NavTreeview from "./NavTreeview.vue";

export default {
    components:{
        NavItem, NavTreeview
    }
}
</script>
