function url ( string = null ) {
    string = string != null ? '/'+string : '/';
    return config.url+string;
}

function api ( string = null ) {
    string = string != null ? '/'+string : '/';
    return config.url+'/'+config.admin_path+'/api'+string;
}

function ucwords(value){
    return value.replace(/\b\w/g, function(l){ return l.toUpperCase() });
}

function errorResponse(app, error, callback = null){
    try{
        let code = error.response.status;

        if (code == 422 && callback){
            callback(app, error);
        }
        else if ( code == 401){
            app.$toast.error(error.message);
            document.location.reload();
        }
        else {
            app.$toast.error(error.message);
        }
    } catch( e ){
        //app.$toast.error(error);
    }
}

function can(roles = [] ){
    let act = roles.includes( this.$config.role );
    return act;
}

function hasWalikelas( has_siswa = '-' ){
    let has = false;
    if ( has_siswa == 1 ){
        has = true;
    } else if ( has_siswa == '-' ) {
        has = this.$config.walikelas ? true : false;
    }
    return has;
}

export { url, api, errorResponse, ucwords, can, hasWalikelas};
