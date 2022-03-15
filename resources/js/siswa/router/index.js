import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/Home.vue";
import Biodata from "../views/siswas/Biodata.vue";
import FormSiswa from "../views/siswas/FormSiswa.vue";
import FormAyah from "../views/siswas/FormAyah.vue";
import FormIbu from "../views/siswas/FormIbu.vue";
import FormWali from "../views/siswas/FormWali.vue";
import FormFile from "../views/siswas/FormFile.vue";

const routes = [
    { path : '/', name : 'Home', component : Home },
    {
        path : '/biodata',
        component : Biodata,
        children:[
            { path : '', name : 'Biodata', component : FormSiswa },
            { path : 'ayah', name : 'FormAyah', component : FormAyah },
            { path : 'ibu', name : 'FormIbu', component : FormIbu },
            { path : 'wali', name : 'FormWali', component : FormWali },
            { path : 'file', name : 'FormFile', component : FormFile },
        ]
    },
];

const router = createRouter({
  history: createWebHistory( config.path ),
  routes,
});

export default router;
