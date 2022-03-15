<template>
    <content :title="title.full+' Siswa'" :icon="title.icon">
        <!-- Default box -->
        <div class="row">
            <div class="col-sm-3">
                <download-siswa-aktif :kelas="kelas" />
            </div>
            <div class="col-sm-3">
                <download-siswa-tingkat  />
            </div>
             <div class="col-sm-3">
                <download-siswa-alumni :tahun="tahun"  />
            </div>
            <div class="col-sm-3">
                <download-siswa-keluar :tahun="tahun"  />
            </div>
        </div>
        <!-- /.card -->
    </content>
</template>

<script>
import DownloadSiswaAktif from "./DownloadSiswaAktif.vue";
import DownloadSiswaTingkat from "./DownloadSiswaTingkat.vue";
import DownloadSiswaAlumni from "./DownloadSiswaAlumni.vue";
import DownloadSiswaKeluar from "./DownloadSiswaKeluar.vue";

export default {
    components:{
        DownloadSiswaAktif,
        DownloadSiswaTingkat,
        DownloadSiswaAlumni,
        DownloadSiswaKeluar
    },
    data(){
        return {
            title          : this.$title.download,
            kelas          : [],
            tahun: [],
            kelas_xii      : []
        }
    },
    beforeMount(){
        this.getData();
    },
    methods:{
        getData(){
            let app = this;
            let url = app.$api('download/siswa/select');
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.kelas = response.data.kelas;
                app.tahun = response.data.tahun;
                app.kelas_xii = response.data.kelas_xii;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        }
    }
}
</script>
