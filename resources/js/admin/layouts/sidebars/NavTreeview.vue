<template>
    <li class="nav-item" :class="{ 'menu-open' : hasActive() }">
        <a href="#" class="nav-link" :class="{ 'active' : hasActive() }">
            <i class="nav-icon" :class="icon"></i>
            <p>
                {{ name }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" :style="style">
            <slot></slot>
        </ul>
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
            default: 'fas fa-circle'
        },
        route : {
            type   : Array,
            default: []
        }
    },
    data(){
        return{
            style:'',
        }
    },
    mounted(){
        this.style = this.display();
    },
    methods:{
        hasActive(){
            let act = this.route.includes( this.$route.name );
            return act;
        },
        display(){
            if (this.hasActive()) {
                return 'display:block;';
            } else {
                return '';
            }
        }
    }
}
</script>
