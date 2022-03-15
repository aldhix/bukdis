const methodsFormGantiPassword = {
    formDisabled(value = true){
        this.active = !value;
        $("#statusModal input, #statusModal button ").prop('disabled',value);
    },
    formClear(){
        this.input.status = this.status,
        this.errors = null,
        this.formDisabled(false);
    },
    show(){
        $('#statusModal').modal('show');
    },
    hide(){
        this.formClear();
        $('#statusModal').modal('hide');
    }
}

export default methodsFormGantiPassword;
