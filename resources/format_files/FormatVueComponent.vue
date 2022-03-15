<template>
    <button :type="type">FormatVueComponent</button>
</template>

<script>
export default {
    props:{
        type : {
            type   : String,
            default: 'button'
        }
    }
}
</script>
