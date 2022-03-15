<template>
    <div v-if="filename" class="mx-auto" style="width:150px;">
        <button type="button" class="btn btn-sm btn-light btn-zoom-foto" v-if="img_loaded" @click="window()">
            <i class="fas fa-search"></i>
        </button>
        <v-lazy-image :src="filename" @load="img_loaded = true"
        class="img-fluid rounded w-100 shadow-sm"
        title="Foto" />
    </div>
    <button type="button" class="btn btn-primary btn-block mt-1" @click="show()" v-if="img_loaded"> <i class="fas fa-cloud-upload-alt mr-1"></i> Upload Foto</button>
    <teleport to="body">
        <modal-form id="uploadModal" @submit.prevent="upload" title="Upload Foto" icon="fas fa-cloud-upload-alt" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input-file v-model="file" id="file" :data-error="errors" />
            <div v-if="progress">
                <progress-bar :value="progress" type="success" />
                <small class="text-primary" v-if="total">{{ total }} record berhasil di import.</small>
            </div>
            <template v-slot:footer>
                <button-batal @click="hide()"/>
                <button-upload :active="active" />
            </template>
        </modal-form>
    </teleport>
</template>

<script>
import methodsFormUpload from "../../libs/methodsFormUpload";
import ButtonUpload from "../../components/ButtonUpload.vue";
import VLazyImage from "v-lazy-image";

export default {
    props:{
        ortu:{
            type: String,
            default: null,
        },
        dataFoto:{
            type:String,
            default:null,
        }
    },
    components:{
        ButtonUpload,
        VLazyImage,
    },
    data(){
        return{
            url_api   : 'siswa',
            active    : true,
            file      : '',
            progress  : 0,
            total     : 0,
            errors    : null,
            filename  : this.dataFoto,
            img_loaded: false
        }
    },
    methods:{
        ...methodsFormUpload.methods,
        upload(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = null;
            if (this.ortu){
                url = app.$api(app.url_api+'/'+siswa+'/foto/'+this.ortu);
            } else {
                url = app.$api(app.url_api+'/'+siswa+'/foto');
            }

            var formData = new FormData();
            var imagefile = $('#file')[0];
            formData.append("file", imagefile.files[0]);

            app.$http.post(url, formData, {
                headers: { ...app.$headers.ajax, ...app.$headers.json },
                onUploadProgress: function( prog ) {
                    app.progress = Math.round((prog.loaded * 100) / prog.total)
                }
            })
            .then( response =>{
                app.filename = response.data.filename;
                app.$toast.saved('File telah berhasil diupload ke serve.');
                app.hide();
            })
            .catch( error =>{
               app.formDisabled(false);
               app.$errorResponse(app, error, function(app, error){
                   app.total = 0;
                   app.progress = 0;
                   app.errors = error.response.data;
               });
            });
        },
        window(){
            let wh = $(window).height();
            let h = Math.ceil( wh - (wh * 20 / 100) );
            let rasio = Math.ceil( h/3 );
            let w = rasio * 4;
            let url = this.filename.replace('/thumb_','/');
            window.open(url, '_blank', 'location=yes,height='+h+',width='+w+',scrollbars=yes,status=yes');
        }
    }
}
</script>
