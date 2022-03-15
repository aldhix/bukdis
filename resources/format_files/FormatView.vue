<template>
    <content title="FormatView" :icon="title.icon">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ title.full }}</h3>
            </div>
            <div class="card-body">
            Start creating your amazing application!
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </content>
</template>

<script>
export default {
    data(){
        return {
            title: this.$title.blank
        }
    }
}
</script>
