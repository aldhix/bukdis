<template>
    <div :class="group">
        <label v-if="label">{{ label }}</label>
        <textarea
          class="form-control form-control-sm"
          :class="{ 'is-invalid' : hasError() }"
          :value="modelValue"
          v-bind="$attrs"
          :id="id"
          @keyup="removeError()"
          @input="$emit('update:modelValue', $event.target.value)"
         ></textarea>
         <div class="invalid-tooltip" v-if="hasError()">
             {{ message() }}
         </div>
         <div class="form-text text-muted" v-if="hasHelper()">
             <small>
                 <slot name="helper"></slot>
             </small>
         </div>
    </div>
</template>

<script>
import methodsInput from "../libs/methodsInput";
export default {
    inheritAttrs: false,
    emits: ['update:modelValue'],
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
        ...methodsInput
    }
}
</script>
