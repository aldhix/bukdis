<template>
    <teleport to="body">
        <modal-form id="deleteModal" @submit.prevent="deleted" :title="'Hapus '+title.full" icon="fas fa-trash" type="modal-sm" @click-close="hide" data-backdrop="static" data-keyboard="false">
            Apakah yakin  "{{ row.nama_kelas }}" akan dihapus?
            <template v-slot:footer>
                <button-batal @click="hide()"/>
                <button-hapus :active="active" />
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
            ...methodsForm.data
        }
    },
    methods:{
        ...methodsForm.delete,
        deleted(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let id = this.row.id;
            let url = app.$api(app.url_api+'/'+siswa+'/kelas/'+id);

            app.$http.delete(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.hide();
                app.$parent.get();
                app.$toast.deleted(app.title.full+' telah berhasil dihapus pada database.');
            })
            .catch( error =>{
               app.$errorResponse(app, error);
            })
        },
    }
}
</script>
