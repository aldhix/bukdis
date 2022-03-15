<template>
    <teleport to="body">
        <modal-form id="editModal" @submit.prevent="put" :title="'Edit '+title.full" icon="fas fa-edit" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Kelas*" v-model="input.nama_kelas" id="edit.nama_kelas" :data-error="errors">
                <template v-slot:helper>
                    Contoh Format : X RPL A atau XI GP atau XIII GP B
                </template>
            </form-input>
            <form-select label="Wali Kelas*" v-model="input.user_id" id="edit.user_id" :data-error="errors">
                <option value="">Pilih :</option>
                <option v-if="walikelas" v-for="(row,index) in walikelas" :value="row.id" :key="row.id" >
                    {{ row.nama_lengkap }}
                </option>
            </form-select>
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
            url_api: 'kelas',
            walikelas : null,
            ...methodsForm.data
        }
    },
    methods:{
        ...methodsForm.editNotShow,
        show( data = null ){
            if (data){
                this.getWalikelas(data)
            } else {
                this.$toast.error('Tidak ada data.')
            }
        },
        getWalikelas(data = null){
            let app = this;
            let id = data.id;
            let url = app.$api(app.url_api+'/walikelas?id='+id);

            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.walikelas = response.data
                app.edit(data);
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
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
