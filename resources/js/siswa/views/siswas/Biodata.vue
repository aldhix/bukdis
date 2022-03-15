<template>
    <div class="card shadow-sm card-light">
        <div class="card-header bg-primary border-bottom-0 p-0 border-0">
            <ul class="nav nav-tabs mt-1 nav-fill">
                <biodata-nav-item name="SISWA" icon="fas fa-id-card" :route="['Biodata']"/>
                <biodata-nav-item name="AYAH" icon="fas fa-id-card" :route="['FormAyah']"/>
                <biodata-nav-item name="IBU" icon="fas fa-id-card" :route="['FormIbu']"/>
                <biodata-nav-item name="WALI" icon="fas fa-id-card" :route="['FormWali']"/>
                <biodata-nav-item name="FILE DOKUMEN" icon="fas fa-cloud-upload-alt" :route="['FormFile']"/>
            </ul>
        </div>
        <div class="card-body border-top-0">
            <router-view />
        </div>
    </div>
</template>
<script>
import BiodataNavItem from "./BiodataNavItem.vue";
export default {
    components:{
        BiodataNavItem
    },
}
</script>
