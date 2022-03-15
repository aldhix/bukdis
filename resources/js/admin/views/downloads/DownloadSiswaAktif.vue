<template>
     <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
               <i :class="$title.siswa.icon"></i>  Siswa Masih Aktif
            </h3>
        </div>
        <div class="card-body">
            <form-select label="Kelas*" v-model="kelas_id" id="kelas" :data-error="errors">
                <option value="">Pilih :</option>
                <option v-for="(row, index) in kelas" :value="row.id" :key="row.id">
                    {{ row.nama_kelas }}
                </option>
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
    props: {
        kelas : {
            type:Array,
            default:[],
        }
    },
    data(){
        return{
            type    : 'aktif',
            kelas_id: '',
            errors  : null,
        }
    },
    methods:{
        validate(){
            if (this.kelas_id){
                this.download();
            } else {
                this.errors = {
                    errors : {
                        'kelas' : ['Kelas wajib diisi.']
                    }
                }
            }
        },
        download(){
            let url = this.$url(this.$config.admin_path+'/download/siswa/download?type='+this.type+'&kelas='+this.kelas_id);
            document.location.href  = url;
        }
    },

}
</script>
