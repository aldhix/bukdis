<template>
    <button type="button" class="btn btn-sm text-secondary p-0 m-0" title="Hapus" @click="edit()">
        <i class="fas fa-trash"></i>
    </button>
</template>
<script>
export default {
    props: {
        data: {
            type:Object,
            default:null
        }
    },
    methods: {
        edit(){
            this.$emit('delete',this.data);
        }
    }
}
</script>
