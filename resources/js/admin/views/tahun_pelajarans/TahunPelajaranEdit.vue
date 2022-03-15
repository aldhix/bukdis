<template>
    <teleport to="body">
        <modal-form id="editModal" @submit.prevent="put" :title="'Edit '+title.full" type="modal-sm" icon="fas fa-edit" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Tahun Pelajaran*" v-model="input.tahun_pelajaran" id="edit.tahun_pelajaran" :data-error="errors">
                <template v-slot:helper>
                   Contoh Format : 2019/2020
                </template>
            </form-input>
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
            url_api: 'tahun_pelajaran',
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
