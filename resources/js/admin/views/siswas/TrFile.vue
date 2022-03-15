<template>
    <tr>
        <td class="text-sm">{{ no }}</td>
        <td><slot/></td>
        <td class="text-sm">{{ filename ? 'Tersedia' : 'Tidak tersedia'}}</td>
        <td>
            <button type="button" class="btn btn-xs btn-success mr-2" title="lihat" v-if="filename" @click="window()">
                Lihat
            </button>
            <button type="button" class="btn btn-xs btn-secondary shadow-none mr-2" title="lihat" v-else disabled>
                Lihat
            </button>
        </td>
    </tr>
</template>
<script>
export default {
    props:['no','jenis','dataFile'],
    data(){
        return{
            filename: this.dataFile,
        }
    },
    methods:{
        window(){
            let wh = $(window).height();
            let h = Math.ceil( wh - (wh * 20 / 100) );
            let rasio = Math.ceil( h/3 );
            let w = rasio * 4;
            let url = this.filename;
            window.open(url, '_blank', 'location=yes,height='+h+',width='+w+',scrollbars=yes,status=yes');
        }
    }
}
</script>
