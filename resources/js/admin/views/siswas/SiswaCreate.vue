<template>
    <button type="button" class="btn btn-primary btn-sm" @click="show">
        <i class="fas fa-plus-circle mr-1"></i> Tambah {{ title.full }}
    </button>
    <teleport to="body">
        <modal-form id="addModal" @submit.prevent="post" :title="'Tambah '+title.full" icon="fas fa-plus-circle" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <div class="row">
                <div class="col">
                    <form-input label="Nama Lengkap*" v-model="input.nama_lengkap" id="nama_lengkap" :data-error="errors"/>
                    <form-select label="Jenis Kelamin*" v-model="input.gender" id="gender" :data-error="errors">
                        <option value="">Pilih:</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </form-select>
                    <form-select label="Kelas*" v-model="input.kelas_id" id="kelas_id" :data-error="errors">
                        <option value="">Pilih:</option>
                        <option v-for="(row,index) in listKelas" :key="row.id" :value="row.id">{{ row.nama_kelas }}</option>
                    </form-select>
                </div>
                <div class="col">
                    <form-input label="NIS*" v-model="input.nis" id="nis" :data-error="errors"/>
                    <form-input label="Password*" v-model="input.password" type="password" id="password" :data-error="errors"/>
                    <form-input label="Konfirmasi Password*" v-model="input.password_confirmation" type="password" id="password_confirmation" :data-error="errors"/>
                </div>
            </div>
            <template v-slot:footer>
                <button-batal @click="hide()"/>
                <button-simpan :active="active" />
            </template>
        </modal-form>
    </teleport>
</template>
<script>
import methodsForm from "../../libs/methodsForm";

export default {
    props: {
        title : {
            type   : Object,
            default: null,
        },
        listKelas:{
            type:Array,
            default:[]
        },
    },
    data(){
        return {
            url_api: 'siswa',
            ...methodsForm.data
        }
    },
    methods:{
         ...methodsForm.create,
        post(){
            this.formDisabled();
            let app = this;
            let url = app.$api(app.url_api);

            app.$http.post(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.hide();
                app.$parent.$parent.get();
                app.$toast.saved(app.title.full+' telah berhasil disimpan ke database.');
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
