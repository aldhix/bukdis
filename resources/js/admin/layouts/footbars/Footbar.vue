<template>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        <b>Version</b> {{ $config.version }}
        </div>
        <strong>Copyright © 2021- <span v-html="yearNow"></span>  <a href="https://rpl.smkn1padaherang.sch.id/">RPL SMKN 1 Padaherang</a>.</strong>  All rights reserved.
    </footer>
</template>

<script>
export default {
    data(){
        return{
            yearNow : new Date().getFullYear()
        }
    }
}
</script>
