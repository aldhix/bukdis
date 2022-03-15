<template>
    <div :class="group">
        <label v-if="label && hasHelper()" class="mb-0">{{ label }}</label>
        <label v-else>{{ label }}</label>
        <div v-if="hasHelper()">
            <small class="form-text text-muted">
                <slot name="helper"></slot>
            </small>
        </div>
        <div class="custom-file">
            <input
            type="file"
            class="custom-file-input form-control form-control-sm"
            :class="{ 'is-invalid' : hasError() }"
            :value="modelValue"
            v-bind="$attrs"
            :id="id"
            @change="onChange()"
            @input="$emit('update:modelValue', $event.target.value)"
            />
            <div class="invalid-tooltip" v-if="hasError()">
                {{ message() }}
            </div>
            <label class="custom-file-label" :for="id">{{ modelValue || 'Pilih file' }}</label>
         </div>
    </div>
</template>

<script>
import methodsInput from "../libs/methodsInput";

export default {
    inheritAttrs: false,
    emits: ['update:modelValue','changeFile'],
    props:{
        modelValue:{
            type:String
        },
        label:{
            type:String,
            default:null
        },
        id : {
          type: String,
          default : ""
        },
        dataError :{
            default:null
        },
        group :{
            type:String,
            default:"form-group"
        }
    },
    methods:{
        ...methodsInput,
        onChange(){
            this.removeError();
            this.$emit('changeFile');
        }
    }
}
</script>
