<template>
    <button type="submit" class="btn btn-primary px-5" v-if="active">
        <i class="fas fa-database mr-"></i> Update
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
