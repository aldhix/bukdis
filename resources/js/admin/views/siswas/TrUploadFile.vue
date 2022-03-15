<template>
    <tr>
        <td>{{ no }}</td>
        <td><slot/></td>
        <td>{{ filename ? 'Sudah diupload' : 'Belum diupload'}}</td>
        <td>
            <button type="button" class="btn btn-sm btn-success mr-2" title="lihat" v-if="filename" @click="window()">
                Lihat
            </button>
            <button type="button" class="btn btn-sm btn-secondary shadow-none mr-2" title="lihat" v-else disabled>
                Lihat
            </button>
            <button type="button" class="btn btn-sm btn-primary" title="upload" @click="show()">
                Upload
            </button>
        </td>
    </tr>
    <teleport to="body">
        <modal-form :id="jenis+'Modal'" @submit.prevent="upload" title="Upload File" icon="fas fa-cloud-upload-alt" @click-close="hide" data-backdrop="static" data-keyboard="false">
            <form-input-file v-model="file" :id="'file_'+jenis" :data-error="errors" />
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
import methodsFormUploadFile from "../../libs/methodsFormUploadFile";
import ButtonUpload from "../../components/ButtonUpload.vue";
export default {
    props:['no','jenis','dataFile'],
    components:{
        ButtonUpload
    },
    data(){
        return{
            url_api : 'siswa',
            active  : true,
            file    : '',
            progress: 0,
            total   : 0,
            errors  : null,
            filename: this.dataFile,
        }
    },
    methods:{
        ...methodsFormUploadFile.methods,
        upload(){
            this.formDisabled();
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/file/'+this.jenis);

            var formData = new FormData();
            var imagefile = $('#file_'+this.jenis)[0];
            formData.append("file_"+this.jenis, imagefile.files[0]);

            app.$http.post(url, formData, {
                headers: { ...app.$headers.ajax, ...app.$headers.json },
                onUploadProgress: function( prog ) {
                    app.progress = Math.round((prog.loaded * 100) / prog.total)
                }
            })
            .then( response =>{
                app.filename = response.data.filename;
                app.$toast.saved('File telah berhasil diupload ke server.');
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
            let url = this.filename;
            window.open(url, '_blank', 'location=yes,height='+h+',width='+w+',scrollbars=yes,status=yes');
        }
    }
}
</script>
