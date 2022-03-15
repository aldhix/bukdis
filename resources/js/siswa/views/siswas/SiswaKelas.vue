<template>
    <div class="form-inline">
        <label>Kelas :</label> <br>
    </div>
    <bs-table class="mt-2">
        <thead>
            <tr>
                <th></th><th>Tahun Pelajaran</th><th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in kelas" v-if="kelas.length > 0" :key="row.id">
                <td>{{ ++index }}</td>
                <td>{{ row.tahun_pelajaran}}</td>
                <td>{{ row.nama_kelas }}</td>
            </tr>
        </tbody>
    </bs-table>
</template>
<script>
export default {

    props:{
        dataKelas : {
            type: Array,
            default : []
        }
    },
    data(){
        return{
            url_api: 'siswa',
            kelas : this.dataKelas,
        }
    },
}
</script>
