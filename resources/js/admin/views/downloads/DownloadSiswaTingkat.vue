<template>
     <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
               <i :class="$title.siswa.icon"></i>  Siswa Aktif Per-Tingkat
            </h3>
        </div>
        <div class="card-body">
            <form-select label="Tingkat*" v-model="tingkat" id="tingkat" :data-error="errors">
                <option value="">Pilih :</option>
                <option value="10">Tingkat X</option>
                <option value="11">Tingkat XI</option>
                <option value="12">Tingkat XII</option>
                <option value="13">Tingkat XIII</option>
            </form-select>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-right">
            <button type="button" class="btn btn-primary" @click="validate()">
               <i class="fas fa-file-download"></i> Download
            </button>
        </div>
        <!-- /.card-footer-->
    </div>
</template>

<script>
export default {
    data(){
        return{
            type   : 'tingkat',
            errors : null,
            tingkat: '',
        }
    },
    methods:{
        validate(){
            if (this.tingkat){
                this.download();
            } else {
                this.errors = {
                    errors : {
                        'tingkat' : ['Tingkat wajib diisi.']
                    }
                }
            }
        },
        download(){
            let url = this.$url(this.$config.admin_path+'/download/siswa/download?type='+this.type+'&tingkat='+this.tingkat);
            document.location.href  = url;
        }
    },

}
</script>
