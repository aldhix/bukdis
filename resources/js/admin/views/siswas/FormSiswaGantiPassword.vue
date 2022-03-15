<template>
    <button type="button" class="btn btn-primary btn-block mt-2" @click="show">
        <i class="fas fa-key mr-1"></i> Ubah Password
    </button>
    <teleport to="body">
        <modal-form id="passwordModal" @submit.prevent="post" title="Ubah Password" icon="fas fa-key" type="modal-sm" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input label="Password Baru*" v-model="input.password_baru" id="password_baru" :data-error="errors" type="password"/>
            <form-input label="Konfirmasi Password Baru*" v-model="input.password_baru_confirmation" id="password_baru_confirmation" :data-error="errors" type="password"/>
            <template v-slot:footer>
                <button-batal @click="hide()"/>
                <button-update :active="active" />
            </template>
        </modal-form>
    </teleport>
</template>
<script>
import methodsFormGantiPassword from "../../libs/methodsFormGantiPassword";

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
            input:{},
            errors:null,
            active:true,
        }
    },
    methods:{
         ...methodsFormGantiPassword,
        post(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/biodata/password');

            app.$http.post(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.hide();
                app.$parent.input.password_show = response.data.password;
                app.$toast.saved('Password telah berhasil diubah ke database.');
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
