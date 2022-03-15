const methodsFormBiodata = {
    edit : {
        formDisabled(value = true){
            this.active = !value;
            $("#editForm input, #editForm select, #editForm textarea").prop('disabled',value);
        },
     },
    data:{
        input     : {},
        errors    : null,
        active    : true,
    }
}

export default methodsFormBiodata;
