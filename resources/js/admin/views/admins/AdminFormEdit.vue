<template>
    <teleport to="body">
        <modal-form id="editModal" @submit.prevent="put" :title="'Edit '+title.full" icon="fas fa-edit" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Nama Lengkap*" v-model="input.nama_lengkap" id="edit.nama_lengkap" :data-error="errors"/>
            <div class="row">
                <div class="col">
                    <form-input label="NIP" v-model="input.nip" id="edit.nip" :data-error="errors"/>
                    <form-input label="Email" v-model="input.email" id="edit.email" :data-error="errors"/>
                    <form-select label="Role/Level*" v-model="input.role" id="edit.role" :data-error="errors">
                        <option value="">Pilih :</option>
                        <option value="operator">Operator</option>
                        <option value="guru">Guru</option>
                    </form-select>
                </div>
                <div class="col">
                    <form-input label="Username*" v-model="input.username" id="edit.username" :data-error="errors"/>
                    <form-input type="password" label="Password*" v-model="input.password" id="edit.password" :data-error="errors"/>
                    <form-input type="password" label="Konfirmasi Password*" v-model="input.password_confirmation" id="edit.password_confirmation" :data-error="errors"/>
                </div>
            </div>
            <template v-slot:footer>
                <button-batal @click="hide()"/>
                <button-update :active="active" />
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
        ...methodsForm.edit,
        edit( data = null){
            let app = this;
            let id = data.id;
            let url = app.$api(app.url_api+'/'+id+'/edit');

            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.input = response.data;
                $('#editModal').modal('show');
            })
            .catch( error =>{
                app.$toast.error( error.message );
            })
        },
        put(){
            this.formDisabled();
            let app = this;
            let id = this.input.id;
            let url = app.$api(app.url_api+'/'+id);

            app.$http.put(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.hide();
                app.$parent.get();
                app.$toast.updated(app.title.full+' telah berhasil diperbarui ke database.');
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
