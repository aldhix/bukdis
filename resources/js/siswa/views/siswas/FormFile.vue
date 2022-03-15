<template>
    <bs-table>
        <thead>
            <tr>
                <th>No</th><th>Jenis Dokumen</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr-upload-file no="1" jenis="akta_lahir" :data-file="siswa_file.file_akta_lahir" v-if="siswa_file">
                File Scan Akta Kelahiran
                <small>(Ukuran Maksimal 1000 KB, Jenis File PDF)</small>
            </tr-upload-file>
            <tr-upload-file no="2" jenis="ijazah_sd" :data-file="siswa_file.file_ijazah_sd" v-if="siswa_file">
                File Scan Ijazah SD
                <small>(Ukuran Maksimal 1000 KB, Jenis File PDF)</small>
            </tr-upload-file>
            <tr-upload-file no="3" jenis="ijazah_smp" :data-file="siswa_file.file_ijazah_smp" v-if="siswa_file">
                File Scan Ijazah SMP/MTs
                <small>(Ukuran Maksimal 1000 KB, Jenis File PDF)</small>
            </tr-upload-file>
            <tr-upload-file no="4" jenis="kk" :data-file="siswa_file.file_kk" v-if="siswa_file">
                File Scan Kartu Keluarga
                <small>(Ukuran Maksimal 1000 KB, Jenis File PDF)</small>
            </tr-upload-file>
            <tr-upload-file no="5" jenis="ktp_ayah_ibu" :data-file="siswa_file.file_ktp_ayah_ibu" v-if="siswa_file">
                File Scan KTP Ayah dan Ibu
                <small>(Ukuran Maksimal 1000 KB, Jenis File PDF)</small>
            </tr-upload-file>
            <tr-upload-file no="6" jenis="ktp_wali" :data-file="siswa_file.file_ktp_wali" v-if="siswa_file">
                File Scan KTP Wali <i><u>jika ada</u></i>
                 <small> (Ukuran Maksimal 1000 KB, Jenis File PDF)</small>
            </tr-upload-file>
        </tbody>
    </bs-table>
</template>
<script>
import TrUploadFile from "./TrUploadFile.vue";
export default {
    components:{
        TrUploadFile
    },
    data(){
        return{
            url_api   : 'siswa',
            siswa_file: null
        }
    },
    beforeMount(){
        this.getData();
    },
    methods:{
        getData(){
            let app = this;
            let   url = app.$api(app.url_api+'/file/');

            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.siswa_file = response.data;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        }
    }
}
</script>
