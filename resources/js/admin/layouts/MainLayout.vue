<template>
    <navbar />
    <sidebar />
    <router-view/>
    <footbar />
</template>
<script>
import Navbar from "./navbars/Navbar.vue";
import Sidebar from "./sidebars/Sidebar.vue";
import Footbar from "./footbars/Footbar.vue";

export default {
    components:{
        Navbar, Sidebar, Footbar
    },
}
</script>
