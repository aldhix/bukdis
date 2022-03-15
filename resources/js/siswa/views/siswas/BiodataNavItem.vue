<template>
    <li class="nav-item">
        <router-link :to="goTo()" class="nav-link" :class="{ 'active' : hasActive() }">
            <i class="mr-1" :class="icon" v-if="icon"></i> {{ name }}
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
        route : {
            type   : Array,
            default: []
        },
        icon:{
            type: String,
            default:null,
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
