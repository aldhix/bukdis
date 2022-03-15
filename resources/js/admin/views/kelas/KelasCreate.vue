<template>
    <button type="button" class="btn btn-primary btn-sm" @click="show">
        <i class="fas fa-plus-circle mr-1"></i> Tambah {{ title.full }}
    </button>
    <teleport to="body">
        <modal-form id="addModal" @submit.prevent="post" :title="'Tambah '+title.full" icon="fas fa-plus-circle" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Kelas*" v-model="input.nama_kelas" id="nama_kelas" :data-error="errors">
                <template v-slot:helper>
                    Contoh Format : X RPL A atau XI GP atau XIII GP B
                </template>
            </form-input>
            <form-select label="Wali Kelas*" v-model="input.user_id" id="user_id" :data-error="errors">
                <option value="">Pilih :</option>
                <option v-if="walikelas" v-for="(row,index) in walikelas" :value="row.id" :key="row.id" >
                    {{ row.nama_lengkap }}
                </option>
            </form-select>
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
            url_api: 'kelas',
            walikelas : null,
            ...methodsForm.data
        }
    },
    methods:{
         ...methodsForm.createNotShow,
        show(){
            this.getWalikelas();
            $('#addModal').modal('show');
        },
        getWalikelas(){
            let app = this;
            let url = app.$api(app.url_api+'/walikelas');

            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.walikelas = response.data
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
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
