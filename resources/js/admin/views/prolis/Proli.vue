<template>
    <content :title="title.full" :icon="title.icon">
        <!-- Default box -->
        <div class="card card-light">
            <div class="card-header form-inline py-2">
                <proli-create :title="title" />
                <search v-model="search" @go-search="get" />
            </div>
            <div class="card-body p-0">
                <bs-table>
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>KODE</th><th>{{ title.full.toUpperCase() }}</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="hasRecord()" v-for="(row, index) in data.data">
                            <td><record-numb :data="data" :index="index" /></td>
                            <td>{{ row.kode_proli }}</td>
                            <td>{{ row.nama_proli }}</td>
                            <td class="text-right">
                                <button-edit :data="row" @edit="showModalEdit" class="mr-2" />
                                <button-delete :data="row" @delete="showModalDelete" />
                            </td>
                        </tr>
                        <tr-empty col="4" v-else />
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
    <proli-edit :title="title" ref="editModal" />
    <proli-delete :title="title" ref="deleteModal" />
</template>

<script>
import methodsIndex from '../../libs/methodsIndex';
import ProliCreate from "./ProliCreate.vue";
import ProliDelete from './ProliDelete.vue';
import ProliEdit from './ProliEdit.vue';
export default {
    components:{
        ProliCreate,
        ProliEdit,
        ProliDelete
    },
    data(){
        return {
            title  : this.$title.proli,
            url_api: 'proli',
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
