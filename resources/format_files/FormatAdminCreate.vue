<template>
    <button type="button" class="btn btn-primary btn-sm" @click="show">
        <i class="fas fa-plus-circle mr-1"></i> Tambah {{ title.full }}
    </button>
    <teleport to="body">
        <modal-form id="addModal" @submit.prevent="post" :title="'Tambah '+title.full" icon="fas fa-plus-circle" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Name*" v-model="input.name" id="name" :data-error="errors"/>
            <form-select label="Gender*" v-model="input.gender" id="gender" :data-error="errors">
                <option value="">Pilih:</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </form-select>
            <form-textarea label="Address*" v-model="input.address" id="address" :data-error="errors" />
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
            url_api: 'example',
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
