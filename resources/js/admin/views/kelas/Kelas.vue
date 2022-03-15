<template>
    <content :title="title.full" :icon="title.icon">
        <!-- Default box -->
        <div class="card card-light">
            <div class="card-header form-inline py-2">
                <kelas-create :title="title" />
                <search v-model="search" @go-search="get" />
            </div>
            <div class="card-body p-0">
                <bs-table>
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>{{ title.full.toUpperCase() }}</th><th>{{ $title.proli.full.toUpperCase() }}</th><th>WALI KELAS</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="hasRecord()" v-for="(row, index) in data.data">
                            <td><record-numb :data="data" :index="index" /></td>
                            <td>{{ row.nama_kelas }}</td>
                            <td>{{ row.nama_proli }}</td>
                            <td>{{ row.nama_lengkap}}</td>
                            <td class="text-right">
                                <button-edit :data="row" @edit="showModalEdit" class="mr-2" />
                                <button-delete :data="row" @delete="showModalDelete" />
                            </td>
                        </tr>
                        <tr-empty col="6" v-else />
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
    <kelas-edit :title="title" ref="editModal"/>
    <kelas-delete :title="title" ref="deleteModal"/>
</template>

<script>
import methodsIndex from "../../libs/methodsIndex";
import KelasCreate from "./KelasCreate.vue";
import KelasEdit from "./KelasEdit.vue";
import KelasDelete from "./KelasDelete.vue";
export default {
    components:{
        KelasCreate,
        KelasEdit,
        KelasDelete
    },
    data(){
        return {
            title  : this.$title.kelas,
            url_api: 'kelas',
            search : '',
            data   : null,
        }
    },
    mounted(){
        this.get();
    },
    methods:{
        ...methodsIndex,
        get(page = 1){
            let app = this;
            let search = app.search;
            let url = app.$api(app.url_api+'?page='+page+'&search='+search);

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
