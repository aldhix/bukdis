<template>
    <content :title="title.full+' Siswa Baru'" :icon="title.icon">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <p class="text-muted">
                    <small>
                    Langkah mengimport data Siswa Baru : <br>
                        <ul>
                            <li>Pertama download format siswa apabila belum ada format, pada pengisian data pastikan NIS tidak boleh sama satu sama lain.</li>
                            <li>Selanjutnya Upload file Siswa Baru sesuai format, data tidak akan digabung dengan Master Siswa (database siswa) tetapi disimpan dahulu (transit) didata import.</li>
                            <li>Terakhir setelah yakin data tersebut sudah benar klik "Pindahkan ke Database" untuk memasukan ke data Master Siswa.</li>
                        </ul>
                    </small>
                </p>
                <a :href="$url($config.admin_path+'/import/siswa/format')" class="btn btn-sm btn-secondary mr-2">
                   <i class="fas fa-file-download"></i> Download Format
                </a>
                <form-upload-siswa :btn-active="!active" />
                <button type="button" class="btn btn-sm btn-danger ml-2 mr-2" @click="truncate()" :disabled="data.length <= 0 || !active">
                    <i class="fas fa-eraser"></i> Kosongkan Data Import
                </button>
                <button type="button" class="btn btn-sm btn-success" @click="post()" :disabled="!data.length > 0" v-if="active">
                   <i class="fas fa-file-import"></i> Pindahkan ke Database Siswa
                </button>
                <button type="button" class="btn btn-sm btn-success" disabled v-else>
                   <img :src="$url('images/ajax-loader.svg')" /> Loading...
                </button>
                <import-alert class="mt-3" :show-alert="show_alert" />
            </div>
            <div class="card-body p-0" v-if="data.length > 0">
                <bs-table>
                    <thead>
                        <tr>
                            <th>NO</th><th>NIS</th><th>NAMA SISWA</th><th>P/L</th><th>KELAS</th><th>PASSWORD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-if="data.length > 0" v-for="(row, index) in data" :key="row.id">
                            <td>{{ row.id }}</td>
                            <td>{{ row.nis }}</td>
                            <td>{{ row.nama_lengkap }}</td>
                            <td>{{ row.gender }}</td>
                            <td>{{ row.nama_kelas }}</td>
                            <td>{{ row.password_show }}</td>
                        </tr>
                    </tbody>

                </bs-table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </content>
</template>

<script>
import FormUploadSiswa from "./FormUploadSiswa.vue";
import ImportAlert from "./ImportAlert.vue";
export default {
    components:{
        FormUploadSiswa,
        ImportAlert
    },
    data(){
        return {
            title  : this.$title.import,
            url_api: 'import/siswa',
            data   : [],
            active : true,
            show_alert : false
        }
    },
    beforeMount(){
        this.get();
    },
    methods:{
        get(){
            let app = this;
            let url = app.$api(app.url_api);
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.data = response.data;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
        truncate(){
            let app = this;
            let url = app.$api(app.url_api);

            app.$http.delete(url, {
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.get();
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        },
        post(){
            this.active = false;
            let app = this;
            let url = app.$api(app.url_api);
            app.$http.post(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.get();
                app.$toast.saved('Siswa baru telah berhasil ditambahkan.');
                app.active = true;
                app.show_alert = true;
            })
            .catch( error =>{
                app.active = true;
                app.$errorResponse(app, error);
            })
        },
    }
}
</script>
