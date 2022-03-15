<template>
    <content :title="title.full+' FormatAdminList'" :icon="title.icon">
        <!-- Default box -->
        <div class="card card-light">
            <div class="card-header form-inline py-2">
                <search v-model="search" @go-search="get" />
            </div>
            <div class="card-body p-0">
                <bs-table>
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>NAME</th><th>GENDER</th><th>ADDRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="hasRecord()" v-for="(row, index) in data.data">
                            <td><record-numb :data="data" :index="index" /></td>
                            <td>{{ row.name }}</td>
                            <td>{{ row.gender }}</td>
                            <td>{{ row.address}}</td>
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
</template>

<script>
import methodsIndex from "../../libs/methodsIndex";
export default {
    data(){
        return {
            title  : this.$title.blank,
            url_api: 'example',
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
