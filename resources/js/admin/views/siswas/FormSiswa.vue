<template>
    <form action="?" method="post" @submit.prevent="update">
        <div class="row">
            <div class="col-lg-4">
                <div class="w-75 mx-auto">
                    <form-upload-foto :data-foto="input.foto" v-if="input.foto" />
                    <form-siswa-ganti-password />
                    <p class="mt-3 text-muted" v-if="input.status">
                        <div class="mb-2">ID : {{ input.nomor_id }}</div>
                        <div class="mb-2">Password : {{ input.password_show }}</div>
                        <form-siswa-status :data-status="input.status"  />
                        <div>Dibuat Tanggal : {{ input.tanggal_dibuat }}</div>
                    </p>
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg bg-light p-3 rounded border shadow-sm" id="editForm">
                <div class="row">
                    <div class="col">
                        <form-input label="Nama Lengkap*" v-model="input.nama_lengkap" id="nama_lengkap" :data-error="errors"/>
                        <form-input label="Nama Panggilan" v-model="input.nama_panggilan" id="nama_panggilan" :data-error="errors"/>
                        <form-input label="Tempat Lahir" v-model="input.tempat_lahir" id="tempat_lahir" :data-error="errors"/>
                        <form-input label="Tanggal Lahir" v-model="input.tgl_lahir" id="tgl_lahir" :data-error="errors" type="date"/>
                        <form-select label="Jenis Kelamin*" v-model="input.gender" id="gender" :data-error="errors">
                            <option value="">Pilih:</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </form-select>
                    </div>
                    <!-- .col -->
                    <div class="col">
                        <form-input label="NIS*" v-model="input.nis" id="nis" :data-error="errors"/>
                        <form-input label="NISN" v-model="input.nisn" id="nisn" :data-error="errors"/>
                        <div class="form-group">
                            <siswa-kelas :data-kelas="input.siswa_kelas" v-if="input.siswa_kelas" />
                        </div>
                    </div>
                    <!-- .col -->
                </div>
                <!-- .row -->
                <div class="row mt-3">
                    <div class="col">
                        <form-textarea label="Alamat" v-model="input.alamat" id="alamat" :data-error="errors" rows="5"/>
                    </div>
                    <div class="col">
                        <form-input label="Nomor Handphone" v-model="input.no_hp" id="no_hp" :data-error="errors"/>
                        <form-input label="Alamat Email" v-model="input.email" id="email" :data-error="errors"/>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <form-select label="Agama" v-model="input.agama" id="agama" :data-error="errors">
                            <option value="">Pilih:</option>
                            <option v-for="(v,i) in agama" :key="i" :value="v" >{{v}}</option>
                        </form-select>
                        <form-input label="Golongan Darah" v-model="input.gol_darah" id="gol_darah" :data-error="errors"/>
                        <form-input label="Bahasa Sehari-hari" v-model="input.bahasa" id="bahasa" :data-error="errors"/>
                        <form-input label="Kewarganegaraan" v-model="input.negara" id="negara" :data-error="errors"/>
                        <div class="row">
                            <div class="col">
                                <form-input label="Anak Ke-" v-model="input.anak_ke" id="anak_ke" :data-error="errors"/>
                            </div>
                            <div class="col">
                                <form-input label="Jumlah Saudara" v-model="input.jum_saudara" id="jum_saudara" :data-error="errors"/>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <form-select label="Tinggal Dengan" v-model="input.tinggal_dgn" id="tinggal_dgn" :data-error="errors">
                            <option value="">Pilih:</option>
                            <option v-for="(tv,ti) in tinggal" :key="ti" :value="tv" >{{ tv }}</option>
                        </form-select>
                        <form-textarea label="Alasan Tidak Tinggal Dengan Ayah Dan Ibu Kandung" v-model="input.alasan_tidak_tinggal" id="alasan_tidak_tinggal" :data-error="errors" rows="5"/>
                        <form-select label="Situasi Lingkungan Tempat Tinggal Siswa Berdekatan Dengan" v-model="input.lingkungan" id="lingkungan" :data-error="errors">
                            <option value="">Pilih:</option>
                            <option v-for="(lv,li) in lingkungan" :key="li" :value="lv" >{{ lv }}</option>
                        </form-select>
                    </div>
                </div>
                <!-- ./row -->
            </div>
            <!-- .col -->

        </div>
        <div class="text-right mt-3">
                <button-update :active="active" />
        </div>
    </form>
</template>
<script>
import methodsFormBiodata from "../../libs/methodsFormBiodata";
import FormUploadFoto from "./FormUploadFoto.vue";
import FormSiswaGantiPassword from "./FormSiswaGantiPassword.vue";
import SiswaKelas from "./SiswaKelas.vue";
import FormSiswaStatus from "./FormSiswaStatus.vue";

export default {
    components:{
        FormUploadFoto,
        FormSiswaGantiPassword,
        SiswaKelas,
        FormSiswaStatus,
    },
    data(){
        return{
            ...methodsFormBiodata.data,
            url_api   : 'siswa',
            agama     : ['Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Khonghucu'],
            tinggal   : ['Ayah dan Ibu Kandung','Ayah Kandung Saja','Ibu Kandung Saja','Ayah Tiri/ Ibu Tiri','Wali','Numpang Dengan Keluarga Lain','Menyewa Kamar / Kost','Panti Asuhan'],
            lingkungan: ['Sekolah','Tempat Ibadah','Madrasah / Pesantren','Tangsi / Asrama Militer','Komplek Perumahan','Pasar / Pertokoan','Tempat Hiburan / Bermain','Pabrik','Tempat Olahraga'],
        }
    },
    beforeMount(){
        this.getData();
    },
    methods:{
        ...methodsFormBiodata.edit,
        getData(){
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/biodata');
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.input = response.data
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
        update(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/biodata');

            app.$http.put(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.formDisabled(false);
                app.$toast.updated('Identitas telah berhasil diperbarui ke database.');
            })
            .catch( error =>{
               app.formDisabled(false);
               app.$errorResponse(app, error, function(app, error){
                   app.errors = error.response.data
               });
            })
        },
    }
}
</script>
