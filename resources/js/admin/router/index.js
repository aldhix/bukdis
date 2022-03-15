import { createWebHistory, createRouter } from "vue-router";
import MainLayout from "../layouts/MainLayout.vue"
import Home from "../views/Home.vue";
import Admin from "../views/admins/Admin.vue";
import Proli from "../views/prolis/Proli.vue";
import Kelas from "../views/kelas/Kelas.vue";
import TahunPelajaran from "../views/tahun_pelajarans/TahunPelajaran.vue";
import Siswa from "../views/siswas/Siswa.vue";
import Biodata from "../views/siswas/Biodata.vue";
import FormSiswa from "../views/siswas/FormSiswa.vue";
import FormAyah from "../views/siswas/FormAyah.vue";
import FormIbu from "../views/siswas/FormIbu.vue";
import FormWali from "../views/siswas/FormWali.vue";
import FormFile from "../views/siswas/FormFile.vue";
import BiodataData from "../views/siswas/BiodataData.vue";
import SiswaAlumni from "../views/siswas/SiswaAlumni.vue";
import SiswaKeluar from "../views/siswas/SiswaKeluar.vue";
import AdminProfile from "../views/admins/AdminProfile.vue";
import Walikelas from "../views/siswas/Walikelas.vue";
import ImportSiswa from "../views/imports/ImportSiswa.vue";
import DownloadSiswa from "../views/downloads/DownloadSiswa.vue";

const routes = [
  {
    path: '/',
    component: MainLayout,
    children :[
        { path : '', name : 'Home', component : Home },
        { path : 'profile', name : 'AdminProfile', component : AdminProfile },
        { path : 'admin', name : 'Admin', component : Admin },
        { path : 'proli', name : 'Proli', component : Proli },
        { path : 'kelas', name : 'Kelas', component : Kelas },
        { path : 'tahun_pelajaran', name : 'TahunPelajaran', component : TahunPelajaran },
        { path : 'siswa', name : 'Siswa', component : Siswa },
        {
            path     : 'siswa/:siswa/biodata/',
            component: Biodata,
            children : [
                { path : '', name : 'Biodata', component : BiodataData  },
                { path : 'siswa', name : 'FormSiswa', component : FormSiswa },
                { path : 'ayah', name : 'FormAyah', component : FormAyah },
                { path : 'ibu', name : 'FormIbu', component : FormIbu },
                { path : 'wali', name : 'FormWali', component : FormWali },
                { path : 'file', name : 'FormFile', component : FormFile },
            ]
        },
        { path : 'siswa/alumni', name : 'SiswaAlumni', component : SiswaAlumni },
        { path : 'siswa/keluar', name : 'SiswaKeluar', component : SiswaKeluar },
        { path : 'walikelas', name : 'Walikelas', component : Walikelas },
        { path : 'import/siswa', name : 'ImportSiswa', component : ImportSiswa },
        { path : 'download/siswa', name : 'DownloadSiswa', component : DownloadSiswa },
    ]
  },
];

const router = createRouter({
  history: createWebHistory( config.path ),
  routes,
});

export default router;
