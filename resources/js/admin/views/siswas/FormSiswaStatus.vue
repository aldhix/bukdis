<template>
    <div class="mb-2" v-if="status">
        <span>
        Status : <strong> {{ status.toUpperCase()  }} </strong>
        </span>
        <button type="button" class="btn btn-xs btn-primary ml-2" @click="show()" v-if="$can(['admin','operator'])">
            <i class="fas fa-edit"></i> Ubah Status
        </button>
    </div>
    <teleport to="body" v-if="$can(['admin','operator'])">
        <modal-form id="statusModal" @submit.prevent="post" title="Ubah Status" icon="fas fa-edit" type="modal-sm" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-select label="Status Siswa*" v-model="input.status" id="status" :data-error="errors">
                <option value="">Pilih : </option>
                <option v-for="(r,i) in list_status" :value="r.value" :key="i">{{ r.label }}</option>
            </form-select>
            <form-textarea label="Keterangan" v-model="input.keterangan" id="keterangan" :data-error="errors" v-if="input.status == 'keluar'" />
            <template v-slot:footer>
                <button-batal @click="hide()"/>
                <button-update :active="active" />
            </template>
        </modal-form>
    </teleport>
</template>

<script>
import methodsFormStatus from "../../libs/methodsFormStatus";

export default {
    props: {
        title : {
            type   : Object,
            default: null,
        },
        dataStatus:{
            type: String,
            default:null,
        }
    },
    data(){
        return {
            url_api: 'siswa',
            input:{},
            errors:null,
            active:true,
            status : this.dataStatus,
            list_status:[
                {value:'aktif',label:'Aktif'},
                {value:'alumni',label:'Alumni'},
                {value:'keluar',label:'Keluar'},
            ]
        }
    },
    methods:{
         ...methodsFormStatus,
        post(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/biodata/status');

            app.$http.post(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.hide();
                app.status = response.data.status
                app.input.status = app.status;
                app.$toast.saved('Status siswa telah berhasil diubah ke database.');
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

