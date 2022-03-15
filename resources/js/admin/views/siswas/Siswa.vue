<template>
    <content :title="title.full" :icon="title.icon">
        <!-- Default box -->
        <div class="card card-light">
            <div class="card-header form-inline py-2">
                <siswa-create :list-kelas="list_kelas" :title="title" v-if="$can(['admin','operator'])" />
                <siswa-search :list-kelas="list_kelas"  @go-search="get" />
            </div>
            <div class="card-body p-0">
                <bs-table>
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>NIS</th><th>NAMA</th><th>P/L</th><th>KELAS</th><th v-if="$can(['admin','operator'])">PASSWORD</th><th>STATUS</th><th></th>
                            <th v-if="$can(['admin','operator'])"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in data.data" v-if="hasRecord()">
                            <td><record-numb :data="data" :index="index" /></td>
                            <td>{{ row.nis }}</td>
                            <td>{{ row.nama_lengkap }}</td>
                            <td>{{ row.gender}}</td>
                            <td>{{ row.nama_kelas}}</td>
                            <td v-if="$can(['admin','operator'])">{{ row.password_show }}</td>
                            <td>{{ $ucwords( row.status ) }}</td>
                            <td>
                                <router-link class="btn btn-xs btn-success my-0 ml-0 mr-2" :title="'Biodata '+title.full" :to="{name:'Biodata', params:{ 'siswa': row.id }}" >
                                    <i class="fas fa-address-book"></i> Biodata
                                </router-link>
                            </td>
                            <td class="text-right" v-if="$can(['admin','operator'])">
                                <button-delete :data="row" @delete="showModalDelete" />
                            </td>
                        </tr>
                        <tr-empty col="9" v-else />
                    </tbody>
                </bs-table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer form-inline py-2">
                <record-info :data="data" />
                <record-page :data="data" @click-page="get" />
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </content>
    <siswa-delete :title="title" ref="deleteModal" v-if="$can(['admin','operator'])" />
</template>

<script>
import methodsIndex from "../../libs/methodsIndex";
import SiswaSearch from "./SiswaSearch.vue";
import SiswaCreate from "./SiswaCreate.vue";
import SiswaDelete from "./SiswaDelete.vue";
export default {
    components:{
        SiswaSearch,
        SiswaCreate,
        SiswaDelete
    },
    data(){
        return {
            title     : this.$title.siswa,
            url_api   : 'siswa',
            data      : null,
            list_kelas: [],
        }
    },
    beforeMount(){
        this.get();
        this.getKelas();
    },
    methods:{
        ...methodsIndex,
        getKelas(){
            let app = this;
            let url = app.$api(app.url_api+'/kelas');
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.list_kelas = response.data
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
        get(page = 1, search = '', kelas = ''){
            let app = this;
            let url = app.$api(app.url_api+'?page='+page+'&search='+search+'&kelas='+kelas);
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.data = response.data
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        }
    }
}
</script>
