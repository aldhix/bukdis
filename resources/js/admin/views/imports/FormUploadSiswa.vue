<template>
    <button type="button" class="btn btn-primary btn-sm" @click="show()" :disabled="btnActive">
        <i class="fas fa-cloud-upload-alt mr-1"></i>Upload Siswa Baru</button>
    <teleport to="body">
        <modal-form-import id="uploadModal" @submit.prevent="upload" title="Upload Siswa" icon="fas fa-cloud-upload-alt" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input-file-import v-model="file" id="file" :data-error="errors" @change-file="changeFile()" />
            <div v-if="progress" class="mb-2">
                <progress-bar :value="progress" type="success" />
                <small class="text-primary" v-if="total">{{ total }} record berhasil di import.</small>
            </div>
            <div class="form-group text-right">
                <button-batal @click="hide()" class="mr-2"/>
                <button-upload :active="active" />
            </div>
            <div class="form-group text-danger" v-if="errors && !errors.errors.file">
                <p class="py-0 my-0">
                    <small> Ada kesalahan pada data record: </small>
                </p>
                <ul class="error-all">
                    <li class="mr-2" v-for="(key, index) in errors.errors" :key="index" >{{ key[0] }}</li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </modal-form-import>
    </teleport>
</template>

<script>
import ModalFormImport from "../../components/ModalFormImport.vue"
import methodsFormUpload from "../../libs/methodsFormUpload";
import ButtonUpload from "../../components/ButtonUpload.vue";
import FormInputFileImport from "./FormInputFileImport.vue";

export default {
    props:{
        ortu:{
            type: String,
            default: null,
        },
        dataFoto:{
            type:String,
            default:null,
        },
        btnActive : {
            type:Boolean,
            default:false,
        }
    },
    components:{
        ButtonUpload,
        ModalFormImport,
        FormInputFileImport,
    },
    data(){
        return{
            url_api   : 'import',
            active    : true,
            file      : '',
            progress  : 0,
            total     : 0,
            errors    : null,
            filename  : this.dataFoto,
            img_loaded: false,
        }
    },
    methods:{
        ...methodsFormUpload.methods,
        changeFile(){
            this.errors = null;
        },
        upload(){
            this.formDisabled();
            let app = this;
            let url = app.$api(app.url_api+'/siswa/upload');

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
                app.$parent.$parent.get();
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
    }
}
</script>
