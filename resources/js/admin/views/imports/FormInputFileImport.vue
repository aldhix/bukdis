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
            :class="{ 'is-invalid' : hasErrors() }"
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
import methodsInput from "../../libs/methodsInput";

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
        hasErrors(){
            let data = this.dataError;
            return data ? true : false;
        },
        hasError(){
            let data = this.dataError;
            let id = this.id.replace('edit.','');
            let err = false;
            try{
                err = id in data.errors;
            } catch ( error ){
                //
            }
            return err;
        },
        message(){
            let msg = "";
            let id = this.id.replace('edit.','');
            if(this.hasError()){
                msg = this.dataError.errors[id][0];
            }
                return msg;
        },
        hasHelper(){
            return !!this.$slots.helper;
        },
        removeError(){
            let data = this.dataError;
            let id = this.id.replace('edit.','');
            try{
                delete data.errors[id];
            } catch ( error ){
                //
            }
        },
        onChange(){
            this.removeError();
            this.$emit('changeFile');
        }
    }
}
</script>
