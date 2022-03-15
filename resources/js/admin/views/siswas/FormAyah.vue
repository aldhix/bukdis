<template>
    <form action="?" method="post" @submit.prevent="update">
        <div class="row">
            <div class="col-lg-4">
                <div class="w-75 mx-auto">
                    <form-upload-foto :data-foto="input.foto_ayah" v-if="input.foto_ayah" :ortu="ortu"  />
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg bg-light p-3 rounded border shadow-sm" id="editForm">
                <div class="row">
                    <div class="col">
                        <form-input label="Nama Lengkap Ayah" v-model="input.nama_lengkap_ayah" id="nama_lengkap_ayah" :data-error="errors"/>
                        <form-input label="Tempat Lahir Ayah" v-model="input.tempat_lahir_ayah" id="tempat_lahir_ayah" :data-error="errors"/>
                        <form-input label="Tanggal Lahir Ayah" v-model="input.tgl_lahir_ayah" id="tgl_lahir_ayah" :data-error="errors" type="date"/>
                        <form-select label="Agama Ayah" v-model="input.agama_ayah" id="agama_ayah" :data-error="errors">
                            <option value="">Pilih:</option>
                            <option v-for="(v,i) in agama" :key="i" :value="v" >{{v}}</option>
                        </form-select>
                    </div>
                    <!-- .col -->
                    <div class="col">
                        <form-textarea label="Alamat Ayah" v-model="input.alamat_ayah" id="alamat_ayah" :data-error="errors" rows="5"/>
                        <form-input label="Nomor Handphone Ayah" v-model="input.no_hp_ayah" id="no_hp_ayah" :data-error="errors"/>
                    </div>
                </div>
                <!-- .row -->
                <div class="row mt-3">
                    <div class="col">
                        <form-input label="Pendidikan Terakhir Ayah" v-model="input.pend_akhir_ayah" id="pend_akhir_ayah" :data-error="errors"/>
                        <form-input label="Pekerjaan Ayah" v-model="input.pekerjaan_ayah" id="pekerjaan_ayah" :data-error="errors"/>
                    </div>
                    <!-- .col -->
                    <div class="col">
                        <form-textarea label="Alamat Pekerjaan Ayah" v-model="input.alamat_pekerjaan_ayah" id="alamat_pekerjaan_ayah" :data-error="errors" rows="5"/>
                    </div>
                    <!-- .col -->
                </div>
            </div>
            <!-- .col -->
        </div>
        <!-- .row -->
        <div class="text-right mt-3">
            <button-update :active="active" />
        </div>
    </form>
</template>

<script>
import methodsFormBiodata from "../../libs/methodsFormBiodata";
import FormUploadFoto from "./FormUploadFoto.vue";
export default {
    components:{
        FormUploadFoto
    },
    data(){
        return{
            ...methodsFormBiodata.data,
            url_api: 'siswa',
            ortu   : 'ayah',
            agama  : ['Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Khonghucu'],
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
            let url = app.$api(app.url_api+'/'+siswa+'/ortu/'+this.ortu);
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
            let url = app.$api(app.url_api+'/'+siswa+'/ortu/'+this.ortu);

            app.$http.put(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.formDisabled(false);
                app.$toast.updated('Identitas Ayah telah berhasil diperbarui ke database.');
            })
            .catch( error =>{
                app.formDisabled(false);
                app.$errorResponse(app, error, function(app, error){
                    app.errors = error.response.data
                });
            })
        }
    }
}
</script>
