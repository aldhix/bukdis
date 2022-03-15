<template>
    <content>
        <div class="row">
            <div class="col-lg-3 col-6" v-if="$can(['admin'])">
                <small-box label="User Admin" :jumlah="data.jum_admin" bg="bg-primary" icon="fas fa-user-friends" route="Admin"  />
            </div>
            <div class="col-lg-3 col-6" v-if="$hasWalikelas()">
                <small-box :label="'Siswa Kelas '+$config.walikelas.nama_kelas " :jumlah="data.jum_kelas" bg="bg-success" icon="fas fa-house-user" route="Walikelas" />
            </div>
            <div class="col-lg-3 col-6">
                <small-box label="Siswa Aktif" :jumlah="data.jum_aktif" bg="bg-info" :icon="$title.siswa.icon" route="Siswa" />
            </div>
            <div class="col-lg-3 col-6">
                <small-box label="Siswa Alumni" :jumlah="data.jum_alumni" bg="bg-purple" icon="fas fa-graduation-cap" route="SiswaAlumni" />
            </div>
            <div class="col-lg-3 col-6">
                <small-box label="Siswa Keluar" :jumlah="data.jum_keluar" bg="bg-danger" icon="fas fa-user-slash" route="SiswaKeluar" />
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">User</div>
            <div class="card-body">
                <p>Nama : {{ data.user.nama_lengkap }} </p>
                <p>NIP : {{ data.user.nip || '-' }} </p>
                <p>Username : {{ data.user.username }} </p>
                <p>Email : {{ data.user.email || '-' }} </p>
            </div>
        </div>
    </content>
</template>

<script>
export default {
    data(){
        return {
            data: {
                user:{}
            },
        }
    },
    mounted(){
        this.getData();
    },
    methods:{
        getData(){
            let app = this;
            let url = app.$api('dashboard');
            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.data = response.data;
            })
            .catch( error =>{
                app.$errorResponse(app, error);
            })
        }
    }
}
</script>
