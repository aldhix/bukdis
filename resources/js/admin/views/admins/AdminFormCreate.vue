<template>
    <button type="button" class="btn btn-primary btn-sm" @click="show">
        <i class="fas fa-plus-circle mr-1"></i> Tambah {{ title.full }}
    </button>
    <teleport to="body">
        <modal-form id="addModal" @submit.prevent="post" :title="'Tambah '+title.full" icon="fas fa-plus-circle" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Nama Lengkap*" v-model="input.nama_lengkap" id="nama_lengkap" :data-error="errors"/>
            <div class="row">
                <div class="col">
                    <form-input label="NIP" v-model="input.nip" id="nip" :data-error="errors"/>
                    <form-input label="Email" v-model="input.email" id="email" :data-error="errors"/>
                    <form-select label="Role/Level*" v-model="input.role" id="role" :data-error="errors">
                        <option value="">Pilih :</option>
                        <option value="operator">Operator</option>
                        <option value="guru">Guru</option>
                    </form-select>
                </div>
                <div class="col">
                    <form-input label="Username*" v-model="input.username" id="username" :data-error="errors"/>
                    <form-input type="password" label="Password*" v-model="input.password" id="password" :data-error="errors"/>
                    <form-input type="password" label="Konfirmasi Password*" v-model="input.password_confirmation" id="password_confirmation" :data-error="errors"/>
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
    },
    data(){
        return {
            url_api: 'admin',
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
