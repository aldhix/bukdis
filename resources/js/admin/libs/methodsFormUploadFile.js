const methodsFormUploadFile = {
    methods:{
        formDisabled(value = true){
            this.active = !value;
            let jenis = this.jenis;
            $("#"+jenis+"Modal input, #"+jenis+"Modal button ").prop('disabled',value);
        },
        formClear(){
            this.file = '',
            this.errors = null,
            this.total=0;
            this.progress=0;
            this.formDisabled(false);
        },
        show(){
            $('#'+this.jenis+'Modal').modal('show');
        },
        hide(){
            this.formClear();
            $('#'+this.jenis+'Modal').modal('hide');
        }
    },
}

export default methodsFormUploadFile;
