<template>
    <button type="submit" class="btn btn-primary" v-if="active">
        <i class="fas fa-server mr-1"></i> Upload ke Server
    </button>
    <button type="button" class="btn btn-primary" disabled v-else>
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
