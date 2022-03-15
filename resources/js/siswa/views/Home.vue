<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4>Identitas Siswa</h4>
                    <div class="row">
                        <div class="col-4">
                            <div class="mx-auto" style="width:150px;">
                                <img :src="siswa.url_foto" v-if="siswa.url_foto" class="img-thumbnail img-fluid">
                            </div>
                        </div>
                        <div class="col-8">
                            <table class="w-100 table-biodata">
                                <tr-biodata label="Nama Lengkap" :value="siswa.nama_lengkap.toUpperCase()" v-if="siswa.nama_lengkap" />
                                <tr-biodata label="Nama Panggilan" :value="siswa_detail.nama_panggilan" />
                                <tr-biodata label="NIS" :value="siswa.nis" />
                                <tr-biodata label="NISN" :value="siswa_detail.nisn" />
                                <td style="width:50%">Kelas</td>
                                <td style="width:5%" class="text-right">:</td>
                                <td>
                                    <ul v-if="siswa_kelas.length > 1" style="margin:0;padding:0 0 0 15px;">
                                        <li v-for="(row, index) in siswa_kelas" :key="index">
                                            {{ row.nama_kelas }} ( {{ row.tahun_pelajaran }})
                                        </li>
                                    </ul>
                                    <span v-else-if="siswa_kelas.length == 1" v-for="(row, index) in siswa_kelas" :key="index">
                                        {{ row.nama_kelas }} ( {{ row.tahun_pelajaran }})
                                    </span>
                                    <span v-else>-</span>
                                </td>
                                <tr-biodata label="Tempat/ Tanggal Lahir" :value="siswa.ttl" />
                                <tr-biodata label="Anak Ke" :value="siswa_detail.anak_ke" />
                                <tr-biodata label="Jumlah Saudara" :value="siswa_detail.jum_saudara" />
                                <tr-biodata label="Jenis Kelamin" :value="siswa.gender" />
                                <tr-biodata label="Agama" :value="siswa_detail.agama" />
                                <tr-biodata label="Golongan Darah" :value="siswa_detail.gol_darah" />
                                <tr-biodata label="Bahasa Sehari-hari" :value="siswa_detail.bahasa" />
                                <tr-biodata label="Kewarganegaraan" :value="siswa_detail.negara" />
                                <tr-biodata label="Alamat" :value="siswa_detail.alamat" />
                                <tr-biodata label="Nomor Handphone" :value="siswa_detail.no_hp" />
                                <tr-biodata label="Email" :value="siswa.email" />
                                <tr-biodata label="Tinggal Dengan" :value="siswa_detail.tinggal_dgn" />
                                <tr-biodata label="Alasan Tidak tinggal dengan Ayah dan Ibu Kandung" :value="siswa_detail.alasan_tidak_tinggal" />
                                <tr-biodata label="Situasi Lingkungan Tempat Tinggal Siswa Berdekatan Dengan" :value="siswa_detail.lingkungan" />
                                <tr-biodata label="Status" :value="siswa.status.toUpperCase()" v-if="siswa.status" />
                                <tr-biodata label="Keterangan" :value="siswa.keterangan" />
                            </table>
                        </div>
                    </div>
                    <hr>
                    <h4 class="mt-3">File Dokumen</h4>
                    <div class="w-100">
                        <bs-table>
                            <tbody>
                                <tr-file no="1" jenis="akta_lahir" :data-file="siswa_file.file_akta_lahir" v-if="siswa_file">
                                    File Scan Akta Kelahiran
                                </tr-file>
                                <tr-file no="2" jenis="ijazah_sd" :data-file="siswa_file.file_ijazah_sd" v-if="siswa_file">
                                    File Scan Ijazah SD
                                </tr-file>
                                <tr-file no="3" jenis="ijazah_smp" :data-file="siswa_file.file_ijazah_smp" v-if="siswa_file">
                                    File Scan Ijazah SMP/MTs
                                </tr-file>
                                <tr-file no="4" jenis="kk" :data-file="siswa_file.file_kk" v-if="siswa_file">
                                    File Scan Kartu Keluarga
                                </tr-file>
                                <tr-file no="5" jenis="ktp_ayah_ibu" :data-file="siswa_file.file_ktp_ayah_ibu" v-if="siswa_file">
                                    File Scan KTP Ayah dan Ibu
                                </tr-file>
                                <tr-file no="6" jenis="ktp_wali" :data-file="siswa_file.file_ktp_wali" v-if="siswa_file">
                                    File Scan KTP Wali
                                </tr-file>
                            </tbody>
                        </bs-table>
                    </div>
                </div>
                <!-- .col -->
                <div class="col">
                    <h4>Identitas Ayah</h4>
                    <table-ortu :data-ortu="ayah" v-if="ayah" />
                    <hr>
                    <h4 class="mt-3">Identitas Ibu</h4>
                    <table-ortu :data-ortu="ibu" v-if="ibu" />
                    <hr>
                    <h4 class="mt-3">Identitas Wali</h4>
                    <table-ortu :data-ortu="wali" v-if="wali" />
                </div>
                <!-- .col -->
            </div>
        </div>
    </div>
</template>

<script>
import TrBiodata from "./siswas/TrBiodata.vue";
import TableOrtu from "./siswas/TableOrtu.vue";
import TrFile from "./siswas/TrFile.vue";

export default {
    components:{
        TrBiodata,
        TableOrtu,
        TrFile
    },
    data(){
        return {
            url_api     : 'siswa',
            siswa       : {},
            siswa_detail: {},
            siswa_kelas : [],
            ayah        : {},
            ibu         : {},
            wali        : {},
            siswa_file        : null,
        }
    },
    beforeMount(){
        this.getData();
    },
    methods:{
        getData(){
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api);
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.siswa        = response.data.siswa;
                app.siswa_detail = response.data.siswa_detail;
                app.siswa_kelas  = response.data.siswa_kelas;
                app.ayah         = response.data.ayah;
                app.ibu          = response.data.ibu;
                app.wali         = response.data.wali;
                app.siswa_file   = response.data.siswa_file;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        }
    }
}
</script>
