<template>
    <button type="submit" class="btn btn-danger" v-if="active">
        <i class="fas fa-trash mr-1"></i> Ya, Hapus
    </button>
    <button type="button" class="btn btn-danger" disabled v-else>
        <img :src="$url('images/ajax-loader.svg')" /> Loading...
    </button>
</template>
<script>
export default {
    props:{
        active:{
            type: Boolean,
            default: false,
        }
    },
}
</script>
