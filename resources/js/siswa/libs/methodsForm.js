const methodsForm = {
    create:{
        formDisabled(value = true){
            this.active = !value;
            $("#addModal input, #addModal select,  #addModal textarea, #addModal button ").prop('disabled',value);
        },
        formClear(){
            this.input = {},
            this.errors = null,
            this.formDisabled(false);
        },
        show(){
            $('#addModal').modal('show');
        },
        hide(){
            this.formClear();
            $('#addModal').modal('hide');
        }
    },
    createNotShow:{
        formDisabled(value = true){
            this.active = !value;
            $("#addModal input, #addModal select,  #addModal textarea, #addModal button ").prop('disabled',value);
        },
        formClear(){
            this.input = {},
            this.errors = null,
            this.formDisabled(false);
        },
        hide(){
            this.formClear();
            $('#addModal').modal('hide');
        }
    },
    edit : {
        formDisabled(value = true){
            this.active = !value;
            $("#editModal input, #editModal select, #editModal textarea, #editModal button").prop('disabled',value);
        },
        formClear(){
            this.input = {},
            this.errors = null,
            this.formDisabled(false);
        },
        show( data = null ){
            if (data){
                this.edit(data);
            } else {
                this.$toast.error('Tidak ada data.')
            }
        },
        hide(){
            this.formClear();
            $('#editModal').modal('hide');
        }
     },
     editNotShow : {
        formDisabled(value = true){
            this.active = !value;
            $("#editModal input, #editModal select, #editModal textarea, #editModal button").prop('disabled',value);
        },
        formClear(){
            this.input = {},
            this.errors = null,
            this.formDisabled(false);
        },
        hide(){
            this.formClear();
            $('#editModal').modal('hide');
        }
     },
     delete : {
        formDisabled(value = true){
            this.active = !value;
        },
        formClear(){
            this.row = {};
            this.formDisabled(false);
        },
        show( data = null ){
            if (data){
                this.row = data;
                $('#deleteModal').modal('show');
            } else {
                this.$toast.error('Tidak ada data.')
            }
        },
        hide(){
            this.formClear();
            $('#deleteModal').modal('hide');
        }
     },
    data:{
        active: true,
        input : {},
        errors: null,
        row   : {},
    }
}

export default methodsForm;
