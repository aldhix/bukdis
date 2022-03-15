<template>
    <div class="row">
        <div class="col-4">
            <div class="mx-auto" style="width:150px;">
                <img :src="dataOrtu.url_foto_ortu" class="img-thumbnail img-fluid">
            </div>
        </div>
        <div class="col-8">
            <table class="w-100 table-biodata">
                <tr-biodata label="Nama Lengkap" :value="dataOrtu.nama_lengkap_ortu" />
                <tr-biodata label="Tempat/ Tanggal Lahir" :value="dataOrtu.ttl" />
                <tr-biodata label="Agama" :value="dataOrtu.agama_ortu" />
                <tr-biodata label="Alamat" :value="dataOrtu.alamat_ortu" />
                <tr-biodata label="Nomor Handphone" :value="dataOrtu.no_hp_ortu" />
                <tr-biodata label="Pendidikan Terakhir" :value="dataOrtu.pend_akhir_ortu" />
                <tr-biodata label="Pekerjaan" :value="dataOrtu.pekerjaan_ortu" />
                <tr-biodata label="Alamat Pekerjaan" :value="dataOrtu.alamat_pekerjaan_ortu" />
            </table>
        </div>
    </div>
</template>
<script>
import TrBiodata from "./TrBiodata.vue";
export default {
    props:{
        dataOrtu:{
            type:Object,
            default:null,
        }
    },
    components:{
        TrBiodata
    }
}
</script>
