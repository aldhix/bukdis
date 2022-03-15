<template>
    <li class="nav-item">
        <router-link :to="goTo()" class="nav-link" :class="{ 'active' : hasActive() }">
            <i class="nav-icon" :class="icon"></i>
            <p>{{ name }}</p>
        </router-link>
    </li>
</template>

<script>
export default {
    props:{
        name : {
            type   : String,
            default: 'Menu'
        },
        icon : {
            type   : String,
            default: 'far fa-circle'
        },
        route : {
            type   : Array,
            default: []
        }
    },
    data(){
        return {
            current : false,
        }
    },
    mounted(){
        this.hasActive();
    },
    methods:{
        goTo(){
            if (this.route.length > 0) {
                return { name: this.route[0] }
            } else {
                return '#';
            }
        },
        hasActive(){
            let act = this.route.includes( this.$route.name );
            if(!this.current){
                this.current = act;
            }
            return act;
        }
    }
}
</script>
