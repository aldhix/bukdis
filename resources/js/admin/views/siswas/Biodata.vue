<template>
    <content :title="header" icon="fas fa-address-book">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1" v-if="$can(['admin','operator']) || $hasWalikelas(has_siswa)">
                <ul class="nav nav-tabs nav-fill" id="custom-tabs-one-tab" role="tablist">
                    <biodata-nav-item name="DATA" icon="fas fa-clipboard-list" :route="['Biodata']"/>
                    <biodata-nav-item name="SISWA" icon="fas fa-id-card" :route="['FormSiswa']"/>
                    <biodata-nav-item name="AYAH" icon="fas fa-id-card" :route="['FormAyah']"/>
                    <biodata-nav-item name="IBU" icon="fas fa-id-card" :route="['FormIbu']"/>
                    <biodata-nav-item name="WALI" icon="fas fa-id-card" :route="['FormWali']"/>
                    <biodata-nav-item name="FILE DOKUMEN" icon="fas fa-cloud-upload-alt" :route="['FormFile']"/>
                </ul>
            </div>
            <div class="card-body">
                <router-view/>
            </div>
            <!-- /.card -->
        </div>
    </content>
</template>

<script>
import BiodataNavItem from "./BiodataNavItem.vue";
export default {
    components:{
        BiodataNavItem
    },
    data(){
        return {
            header   : 'Biodata '+this.$title.siswa.full,
            title    : this.$title.siswa,
            has_siswa: false,
        }
    },
    beforeMount(){
        this.getData();
    },
    methods:{
        getData(){
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api('walikelas/siswa/'+siswa);
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.has_siswa = response.data == 1 ;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
    }
}
</script>
