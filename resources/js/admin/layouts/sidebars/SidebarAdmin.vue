<template>
    <li class="nav-header">REFERENSI</li>
    <nav-item :name="'Import '+$title.siswa.full+' Baru'" :icon="$title.import.icon" :route="['ImportSiswa']"  />
    <nav-item :name="$title.kelas.full" :icon="$title.kelas.icon" :route="['Kelas']"  />
    <nav-item :name="$title.proli.full" :icon="$title.proli.icon" :route="['Proli']" />
    <nav-item :name="$title.tahun.full" :icon="$title.tahun.icon" :route="['TahunPelajaran']" />
    <nav-item :name="$title.admin.full" :icon="$title.admin.icon" :route="['Admin']" />
</template>
<script>
import NavItem from "./NavItem.vue";
import NavTreeview from "./NavTreeview.vue";

export default {
    components:{
        NavItem, NavTreeview
    },
}
</script>
