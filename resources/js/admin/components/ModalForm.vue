<template>
    <form class="modal" tabindex="-1">
            <div class="modal-dialog" :class="type">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" v-if="title"> <i :class="icon" v-if="icon"></i> {{ title }}</h5>
                        <button type="button" title="Close" class="close" @click="clickClose()" v-if="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer bg-light py-1">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </form>
</template>

<script>
export default {
    props: {
        type:{
            type: String,
            default : ''
        },
        close: {
            type:Boolean,
            default:true,
        },
        title:{
            type:String,
            default:null,
        },
        icon:{
            type:String,
            default:null,
        }
    },
    methods:{
        clickClose(){
            this.$emit('click-close');
        }
    }
}
</script>
