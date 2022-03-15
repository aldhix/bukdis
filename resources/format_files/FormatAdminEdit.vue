<template>
    <teleport to="body">
        <modal-form id="editModal" @submit.prevent="put" :title="'Edit '+title.full" icon="fas fa-edit" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Name*" v-model="input.name" id="edit.name" :data-error="errors"/>
            <form-select label="Gender*" v-model="input.gender" id="edit.gender" :data-error="errors">
                <option value="">Pilih:</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </form-select>
            <form-textarea label="Address*" v-model="input.address" id="edit.address" :data-error="errors" />
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
            url_api: 'example',
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
