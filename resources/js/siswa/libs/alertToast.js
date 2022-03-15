const alertToast = {
    saved(string = null){
        if (string){
            toastr.success('<strong>Simpan Berhasil !</strong> '+string);
        } else {
            toastr.success('<strong>Simpan Berhasil !</strong>');
        }

    },
    updated(string = null){
        if (string){
            toastr.success('<strong>Perbarui Berhasil !</strong> '+string);
        } else {
            toastr.success('<strong>Perbarui Berhasil !</strong>');
        }

    },
    deleted(string = null){
        if (string){
            toastr.success('<strong>Hapus Berhasil !</strong> '+string);
        } else {
            toastr.success('<strong>Hapus Berhasil !</strong>');
        }

    },
    success(string = null){
        if (string){
            toastr.success('<strong>Berhasil !</strong> '+string);
        } else {
            toastr.success('<strong>Berhasil !</strong>');
        }

    },
    fail(string){
        if (string){
            toastr.warning('<strong>Oups !</strong> '+string);
        } else {
            toastr.warning('<strong>Oups !</strong>');
        }
    },
    error(string){
        if (string ){
            toastr.error('<strong>Error !</strong> '+string);
        } else {
            toastr.error('<strong>Error !</strong>');
        }

    }
}
export default alertToast;
