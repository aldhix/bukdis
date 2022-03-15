<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link  :to="{ name : 'Home' }" class="brand-link">
        <img :src="$config.logo" :alt="$config.name" class="brand-image img-rounded" style="opacity: 1">
        <span class="brand-text font-weight-light">{{ $config.name }}</span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <nav-item name="Dashboard" icon="fas fa-tachometer-alt" :route="['Home']" />
                    <nav-item :name="'Kelas '+$config.walikelas.nama_kelas" icon="fas fa-house-user" :route="['Walikelas']" v-if="$hasWalikelas()" />
                    <nav-treeview :name="$title.siswa.full" :icon="$title.siswa.icon"
                     :route="['Siswa','Biodata','FormAyah','FormIbu','FormWali','FormFile','FormSiswa','SiswaAlumni','SiswaKeluar']">
                        <nav-item :name="$title.siswa.short+' Aktif'" :route="['Siswa']" :icon="$title.siswa.icon" />
                        <nav-item :name="$title.siswa.short+' Alumni'" :route="['SiswaAlumni']" icon="fas fa-graduation-cap" />
                        <nav-item :name="$title.siswa.short+' Keluar'" :route="['SiswaKeluar']" icon="fas fa-user-slash" />
                    </nav-treeview>
                    <nav-item :name="$title.download.short+' siswa'" :route="['DownloadSiswa']" :icon="$title.download.icon" />
                    <sidebar-admin v-if="$can(['admin'])" />
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
import SidebarAdmin from "./SidebarAdmin.vue";
export default {
    components:{
        NavItem, NavTreeview, SidebarAdmin
    },
}
</script>
