<template>
    <form action="?" method="post" @submit.prevent="update">
        <div class="row">
            <div class="col-lg-4">
                <div class="w-75 mx-auto">
                    <form-upload-foto :data-foto="input.foto_ibu" v-if="input.foto_ibu" :ortu="ortu" />
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg bg-light p-3 rounded border shadow-sm" id="editForm">
                <div class="row">
                    <div class="col">
                        <form-input label="Nama Lengkap Ibu" v-model="input.nama_lengkap_ibu" id="nama_lengkap_ibu" :data-error="errors"/>
                        <form-input label="Tempat Lahir Ibu" v-model="input.tempat_lahir_ibu" id="tempat_lahir_ibu" :data-error="errors"/>
                        <form-input label="Tanggal Lahir Ibu" v-model="input.tgl_lahir_ibu" id="tgl_lahir_ibu" :data-error="errors" type="date"/>
                        <form-select label="Agama Ibu" v-model="input.agama_ibu" id="agama_ibu" :data-error="errors">
                            <option value="">Pilih:</option>
                            <option v-for="(v,i) in agama" :key="i" :value="v" >{{v}}</option>
                        </form-select>
                    </div>
                    <!-- .col -->
                    <div class="col">
                        <form-textarea label="Alamat Ibu" v-model="input.alamat_ibu" id="alamat_ibu" :data-error="errors" rows="5"/>
                        <form-input label="Nomor Handphone Ibu" v-model="input.no_hp_ibu" id="no_hp_ibu" :data-error="errors"/>
                    </div>
                </div>
                <!-- .row -->
                <div class="row mt-3">
                    <div class="col">
                        <form-input label="Pendidikan Terakhir Ibu" v-model="input.pend_akhir_ibu" id="pend_akhir_ibu" :data-error="errors"/>
                        <form-input label="Pekerjaan Ibu" v-model="input.pekerjaan_ibu" id="pekerjaan_ibu" :data-error="errors"/>
                    </div>
                    <!-- .col -->
                    <div class="col">
                        <form-textarea label="Alamat Pekerjaan Ibu" v-model="input.alamat_pekerjaan_ibu" id="alamat_pekerjaan_ibu" :data-error="errors" rows="5"/>
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
            ortu   : 'ibu',
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
                app.$toast.updated('Identitas Ibu telah berhasil diperbarui ke database.');
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
