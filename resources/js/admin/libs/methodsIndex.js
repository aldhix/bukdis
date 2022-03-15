const methodsIndex = {
    hasRecord(){
        if (this.data){
            if (this.data.data.length > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false
        }

    },
    showModalEdit( data = null ){
        this.$refs.editModal.show(data);
    },
    showModalDelete( data = null ){
        this.$refs.deleteModal.show(data);
    }
}

export default methodsIndex;
