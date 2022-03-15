<template>
    <div class="form-inline">
        <label>Kelas :</label> <br>
        <siswa-kelas-create :title="title" v-if="$can(['admin','operator'])" />
    </div>
    <bs-table class="mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th><th>Tahun Pelajaran</th><th>Kelas</th><th  v-if="$can(['admin','operator'])"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in kelas" v-if="kelas.length > 0" :key="row.id">
                <td>{{ ++index }}</td>
                <td>{{ row.tahun_pelajaran}}</td>
                <td>{{ row.nama_kelas }}</td>
                <td  v-if="$can(['admin','operator'])">
                    <button-delete :data="row" @delete="showModalDelete" />
                </td>
            </tr>
        </tbody>
    </bs-table>
    <siswa-kelas-delete :title="title" ref="deleteModal" />
</template>
<script>
import SiswaKelasCreate from "./SiswaKelasCreate.vue";
import SiswaKelasDelete from "./SiswaKelasDelete.vue";
export default {
    components:{
        SiswaKelasCreate, SiswaKelasDelete
    },
    props:{
        dataKelas : {
            type: Array,
            default : []
        }
    },
    data(){
        return{
            url_api: 'siswa',
            kelas : this.dataKelas,
            title : this.$title.kelas
        }
    },
    methods:{
        get(){
            let app = this;
            let siswa = this.$route.params.siswa;
            let url = app.$api(app.url_api+'/'+siswa+'/kelas/');
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.kelas = response.data;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
        showModalDelete( data = null ){
            this.$refs.deleteModal.show(data);
        }
    }
}
</script>
