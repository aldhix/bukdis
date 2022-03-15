<template>
    <span v-if="getTotal() > 0">{{ showEntry() }}</span>
</template>
<script>
export default {
    props:['data'],
    methods:{
        getTotal(){
            let data = this.data;
            let total = 0;
            try{
                total = 'total' in data ? data.total : total;
            } catch (error){
                //console.log(error);
            }
            return total;
        },
        showEntry(){
            let data = this.data;
            let from = 0;
            let jum_data = 0;
            let total = this.getTotal();

            try{
                from = 'from' in data ? data.from : from;
                jum_data = 'data' in data ? data.data.length : jum_data;
            } catch (error){
                //console.log(error);
            }
            let to = parseInt(from) + jum_data - 1;
            return "Menampilkan "+from+" hingga "+to+" dari "+total+" record";
        }
    }
}
</script>
