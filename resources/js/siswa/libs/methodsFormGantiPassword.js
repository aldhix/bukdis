const methodsFormGantiPassword = {
    formDisabled(value = true){
        this.active = !value;
        $("#passwordModal input, #passwordModal button ").prop('disabled',value);
    },
    formClear(){
        this.input = {},
        this.errors = null,
        this.formDisabled(false);
    },
    show(){
        $('#passwordModal').modal('show');
    },
    hide(){
        this.formClear();
        $('#passwordModal').modal('hide');
    }
}

export default methodsFormGantiPassword;
