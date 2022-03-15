<template>
    <content :title="title.full" :icon="title.icon">
        <div class="row">
            <div class="col-6">
                <form class="card card-primary" method="post" action="?" @submit.prevent="put" id="editForm">
                    <div class="card-header py-1"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form-input label="Nama Lengkap*" v-model="input.nama_lengkap" id="nama_lengkap" :data-error="errors"/>
                                <form-input label="NIP" v-model="input.nip" id="nip" :data-error="errors"/>
                                <form-input label="Email" v-model="input.email" id="email" :data-error="errors"/>
                            </div>
                            <div class="col">
                                <form-input label="Username*" v-model="input.username" id="username" :data-error="errors"/>
                                <form-input type="password" label="Password*" v-model="input.password" id="password" :data-error="errors"/>
                                <form-input type="password" label="Konfirmasi Password*" v-model="input.password_confirmation" id="password_confirmation" :data-error="errors"/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button-update :active="active" />
                    </div>
                </form>
            </div>
        </div>
    </content>
</template>
<script>
export default {
    data(){
        return{
            title  : this.$title.profile,
            url_api: 'profile',
            input  : {},
            errors : null,
            active : true,
        }
    },
    beforeMount(){
        this.edit();
    },
    methods:{
        edit(){
            let app = this;
            let url = app.$api(app.url_api);

            app.$http.get(url,{
                headers: { ...app.$headers.ajax }
            })
            .then( response => {
                app.input = response.data;
            })
            .catch( error =>{
                app.$toast.error( error.message );
            })
        },
        put(){
            this.formDisabled();
            let app = this;
            let url = app.$api(app.url_api);

            app.$http.put(url, app.input, {
                headers: { ...app.$headers.ajax, ...app.$headers.json }
            })
            .then( response =>{
                app.formDisabled(false);
                app.$toast.updated(app.title.full+' telah berhasil diperbarui ke database.');
            })
            .catch( error =>{
               app.formDisabled(false);
               app.$errorResponse(app, error, function(app, error){
                   app.errors = error.response.data
               });
            })
        },
        formDisabled(value = true){
            this.active = !value;
            $("#editForm input, #editForm select, #editForm textarea, #editForm button").prop('disabled',value);
        },
        formClear(){
            this.errors = null,
            this.formDisabled(false);
        },
    }
}
</script>
