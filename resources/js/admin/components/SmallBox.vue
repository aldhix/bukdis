<template>
    <div class="small-box" :class="bg">
        <div class="inner">
        <h3>{{ jumlah }}</h3>
        <p>{{ label }}</p>
        </div>
        <div class="icon">
        <i :class="icon"></i>
        </div>
        <router-link :to="{ name : route }" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
    </div>
</template>

<script>
export default {
    props: {
        label:{
            type:String,
            default:'',
        },
        jumlah:{
            type:[String, Number],
            default:'',
        },
        icon:{
            type:String,
            default:'fas fa-user',
        },
        bg:{
            type:String,
            default:'bg-info',
        },
        route:{
            type:String,
            default:'',
        },

    }
}
</script>
