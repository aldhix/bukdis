<template>
    <span>{{ number() }}</span>
</template>
<script>
export default {
    props:['data','index'],
    methods:{
        number(){
            let data = this.data;
            return parseInt(data.from) + this.index;
        },
    }
}
</script>
