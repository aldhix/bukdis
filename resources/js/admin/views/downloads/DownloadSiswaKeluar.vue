<template>
     <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">
               <i :class="$title.siswa.icon"></i>  Siswa Sudah Keluar
            </h3>
        </div>
        <div class="card-body">
            <form-select label="Tahun Keluar*" v-model="tahun_id" id="tahun_id" :data-error="errors">
                <option value="">Pilih :</option>
                <option v-for="(row, index) in tahun" :value="row.tahun" :key="row.id">
                    {{ row.tahun }}
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
        tahun : {
            type:Array,
            default:[],
        }
    },
    data(){
        return{
            type    : 'keluar',
            tahun_id: '',
            errors  : null,
        }
    },
    methods:{
        validate(){
            if (this.tahun_id){
                this.download();
            } else {
                this.errors = {
                    errors : {
                        'tahun_id' : ['Tahun keluar wajib diisi.']
                    }
                }
            }
        },
        download(){
            let url = this.$url(this.$config.admin_path+'/download/siswa/download?type='+this.type+'&tahun='+this.tahun_id);
            document.location.href  = url;
        }
    },

}
</script>
