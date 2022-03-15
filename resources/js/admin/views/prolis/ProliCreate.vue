<template>
    <button type="button" class="btn btn-primary btn-sm" @click="show">
        <i class="fas fa-plus-circle mr-1"></i> Tambah {{ title.full }}
    </button>
    <teleport to="body">
        <modal-form id="addModal" @submit.prevent="post" :title="'Tambah '+title.full" icon="fas fa-plus-circle" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Kode*" v-model="input.kode_proli" id="kode_proli" :data-error="errors"/>
            <form-input :label="title.full+'*'" v-model="input.nama_proli" id="nama_proli" :data-error="errors"/>
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
            url_api: 'proli',
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
