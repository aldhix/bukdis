<template>
    <div class="progress">
        <div class="progress-bar" :class="'bg-'+type" role="progressbar" :style="'width:'+value+'%'"></div>
    </div>
</template>
<script>
export default {
    props:{
        type:{
            default:'primary'
        },
        value:{
            default:0
        }
    }
}
</script>
