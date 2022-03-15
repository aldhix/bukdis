<template>
    <div :class="group">
        <label v-if="label && hasHelper()" class="mb-0">{{ label }}</label>
        <label v-else>{{ label }}</label>
        <div v-if="hasHelper()">
            <small class="form-text text-muted">
                <slot name="helper"></slot>
            </small>
        </div>
        <input
          class="form-control form-control-sm"
          :class="{ 'is-invalid' : hasError() }"
          :value="modelValue"
          v-bind="$attrs"
          :id="id"
          @keyup="removeError()"
          @input="$emit('update:modelValue', $event.target.value)"
         />
         <div class="invalid-tooltip" v-if="hasError()">
             {{ message() }}
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
            type:[String,Number]
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
