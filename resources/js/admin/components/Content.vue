<template>
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm">
                    <h1 v-if="title"><i :class="icon" v-if="icon"></i> {{ title }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <slot></slot>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    props: {
        title : {
            type   : String,
            default: null,
        },
        icon : {
            type   : String,
            default: null,
        },
    },
    mounted(){
        this.titleHtml();
    },
    methods:{
        titleHtml(){
            if (this.title) {
                $('title').html(this.title+' | '+config.name);
            } else {
                $('title').html(config.name);
            }

        }
    }
}
</script>
