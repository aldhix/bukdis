<template>
    <div class="form-inline ml-auto">
        <div class="input-group input-group-sm">
            <select v-model="kelas" class="form-control" @change="goSearch()">
                <option value="">Semua Kelas</option>
                <option value="kosong">Tidak Ada Kelas </option>
                <option v-for="(row,index) in listKelas" :key="row.id" :value="row.id">{{ row.nama_kelas }}</option>
            </select>
            <input v-model="search" type="text" class="form-control" @keydown.enter="goSearch()" placeholder="Cari...">
            <div class="input-group-append">
                <button type="button" class="btn border-top border-bottom bg-white border-right" @click="goSearch()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        listKelas:{
            type:Array,
            default:[]
        },
    },
    data(){
        return {
            search: '',
            kelas : '',
        }
    },
    methods:{
        goSearch(){
            this.$emit('go-search', 1, this.search, this.kelas);
        },
    }
}
</script>
