const methodsInput = {
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
    }
}

export default methodsInput;
