<template>
    <button type="button" class="btn btn-xs btn-primary ml-auto" @click="show">
        <i class="fas fa-plus-circle mr-1"></i> Tambah {{ title.full }}
    </button>
    <teleport to="body">
        <modal-form id="addModal" @submit.prevent="post" :title="'Tambah '+title.full" icon="fas fa-plus-circle" @click-close="hide" data-backdrop="static" data-keyboard="false">
             <form-select label="Tahun Pelajaran*" v-model="input.tahun_pelajaran" id="tahun_pelajaran" :data-error="errors">
                <option value="">Pilih:</option>
                <option v-for="(tr,ti) in tahun_pelajaran" :key="tr.id" :value="tr.id" v-if="tahun_pelajaran.length > 0">{{ tr.tahun_pelajaran }}</option>
            </form-select>
            <form-select label="Kelas*" v-model="input.kelas" id="kelas" :data-error="errors">
                <option value="">Pilih:</option>
                <option v-for="(kr,ki) in kelas" :key="kr.id" :value="kr.id" v-if="kelas.length > 0">{{ kr.nama_kelas }}</option>
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
            url_api: 'siswa',
            ...methodsForm.data,
            tahun_pelajaran : [],
            kelas : [],
        }
    },
    methods:{
         ...methodsForm.createNotShow,
        show(){
             if (this.kelas.length < 1 || this.tahun_pelajaran.length < 1){
                  this.getSelect();
             } else {
                 $('#addModal').modal('show');
             }
        },
        getSelect(){
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/kelas/select');
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.tahun_pelajaran = response.data.tahun_pelajaran;
                app.kelas = response.data.kelas;
                $('#addModal').modal('show');
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
        post(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/kelas');

            app.$http.post(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.hide();
                app.$parent.get();
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
