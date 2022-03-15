<template>
    <div class="input-group input-group-sm ml-auto">
        <input type="text"
            class="form-control"
            @keydown.enter="goSearch()"
            :value="modelValue"
            v-bind="$attrs"
            @input="$emit('update:modelValue', $event.target.value)"
            placeholder="Cari...">
        <div class="input-group-append">
            <button type="button" class="btn border-top border-bottom bg-white border-right" @click="goSearch()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    emits: ['update:modelValue'],
    props:{
        modelValue:{
            type:String
        },
    },
    methods:{
        goSearch(){
            this.$emit('go-search');
        },
    }
}
</script>
