<template>
    <content :title="title.full" :icon="title.icon">
        <!-- Default box -->
        <div class="card card-light">
            <div class="card-header form-inline py-2">
                <admin-form-create :title="title" />
                <search v-model="search" @go-search="get" />
            </div>
            <div class="card-body p-0">
                <bs-table>
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>NAMA LENGKAP</th><th>USERNAME</th><th>ROLE</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="hasRecord()" v-for="(row, index) in data.data">
                            <td><record-numb :data="data" :index="index" /></td>
                            <td>{{ row.nama_lengkap }}</td>
                            <td>{{ row.username }}</td>
                            <td>{{ row.role}}</td>
                            <td class="text-right">
                                <button-edit class="mr-2" :data="row" @edit="showModalEdit" v-if="row.role != 'Admin'" />
                                <button-delete :data="row" @delete="showModalDelete" v-if="row.role != 'Admin'" />
                            </td>
                        </tr>
                        <tr-empty col="5" v-else />
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
    <admin-form-edit :title="title" ref="editModal" />
    <admin-form-delete :title="title" ref="deleteModal" />
</template>

<script>
import methodsIndex from "../../libs/methodsIndex";
import AdminFormCreate from "./AdminFormCreate.vue";
import AdminFormEdit from "./AdminFormEdit.vue";
import AdminFormDelete from "./AdminFormDelete.vue";
export default {
    components:{
       AdminFormCreate, AdminFormEdit, AdminFormDelete
    },
    data(){
        return {
            title  : this.$title.admin,
            url_api: 'admin',
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
            let app    = this;
            let search = app.search;
            let url    = app.$api(app.url_api+'?page='+page+'&search='+search);

            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.data = response.data
            })
            .catch( error =>{
               app.$errorResponse(app, error);
            })
        },
    }
}
</script>
