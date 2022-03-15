<template>
    <div class="alert alert-success" role="alert" v-if="showAlert">
        <strong>Berhasil di pindahkan!</strong> Siswa Baru telah berhasil dipindahkan ke database Master Siswa.
        Silahkan cek di daftar <router-link :to="{ name : 'Siswa'}"> Siswa Aktif </router-link>
        <button type="button" class="close" @click="hide()">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    props: {
      showAlert:{
          type:Boolean,
          default:true,
      }

    },
    methods:{
        hide(){
            this.$parent.$parent.show_alert = false;
        }
    }
}
</script>
