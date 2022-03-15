const methodsFormUpload = {
    methods:{
        formDisabled(value = true){
            this.active = !value;
            $("#uploadModal input, #uploadModal button ").prop('disabled',value);
        },
        formClear(){
            this.view_image = this.no_image;
            this.file = '',
            this.errors = null,
            this.total=0;
            this.progress=0;
            this.formDisabled(false);
        },
        show(){
            $('#uploadModal').modal('show');
        },
        hide(){
            this.formClear();
            $('#uploadModal').modal('hide');
        }
    },
}

export default methodsFormUpload;
