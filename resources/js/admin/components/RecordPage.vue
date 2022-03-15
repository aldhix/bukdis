<template>
    <ul class="pagination pagination-sm ml-auto m-0" v-if="getLast() > 1">
        <li class="page-item" v-if="prevPageActive()">
            <a class="page-link" href="javascript:;" @click="choosePage( prevPage() )">
                <span>&laquo;</span>
            </a>
        </li>
        <li class="page-item disabled" v-else>
            <a class="page-link" href="javascript:;">
                <span>&laquo;</span>
            </a>
        </li>
         <li class="page-item disabled" v-if="pageFirst() > 0">
            <a class="page-link" href="javascript:;">...</a>
         </li>
         <li class="page-item" v-for="index in pageBatas()" :key="index" :class="{ active: pageActive( index ) }">
            <a class="page-link" href="javascript:;" @click="choosePage( page(index) )">{{ page(index) }}</a>
         </li>
         <li class="page-item disabled" v-if="pageLast()">
            <a class="page-link" href="javascript:;">...</a>
         </li>

         <li class="page-item" v-if="nextPageActive()">
            <a class="page-link" href="javascript:;" @click="choosePage( nextPage() )">
                <span>&raquo;</span>
            </a>
        </li>
         <li class="page-item disabled" v-else>
            <a class="page-link" href="javascript:;">
                <span>&raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
export default {
    props:{
        data : {
            default: null,
        },
        limit:{
            default: 7,
        }
    },
    data(){
        return{
            current_page : 0,
            last_page : 0,
            show:0,
        }
    },
    methods:{
        getCurrent(){
            let current = this.current_page
            try{
                current = 'current_page' in this.data ? this.data.current_page : this.current_page;
            } catch (error){
                //console.log(error)
            }
            return current;
        },
        getLast(){
            let last = this.last_page;
            try{
                last = 'last_page' in this.data ? this.data.last_page : this.last_page;
            } catch (error){
                //console.log(error)
            }
            return last;
        },
        getShow(){
            let show = this.show;
            try{
                show = this.limit > 0 ? this.limit  : this.show;
            } catch (error){
                //console.log(error)
            }
            return show;
        },
        choosePage( p ){
            this.$emit('click-page', p );
        },
        page( index ){
            return this.pageFirst() + index ;
        },
        pageFirst(){
            let current = this.getCurrent() ;
            let show = this.getShow();
            let last = this.getLast();
            let selisih =  current - show ;

            let fg = 0;
            if( selisih <= 1 ) {
                fg = 0;
            } else if( (current + show ) >= last){
                fg = last - ( ( show * 2 ) + 1);
                fg =  fg < 0 ? 0 : fg;
            } else if ( selisih > last) {
                fg = last;
            } else {
                fg = selisih - 1;
            }
            return parseInt(fg);
        },
        pageLast(){
            let current = this.getCurrent();
            let last = this.getLast() ;
            let show = this.getShow();

            return ( this.pageFirst() + this.pageBatas() ) < last;
        },
        pageBatas(){
            let last = this.getLast();
            let show = this.getShow();
            let batas = ( show * 2 ) + 1 ;

            if( batas < last ) {
                return batas;
            } else {
                return last;
            }
        },
        pageActive(index){
            let current = this.getCurrent();
            return this.pageFirst() + index == current;
        },
        prevPage(){
            let current = this.getCurrent();
            return current - 1
        },
        prevPageActive(){
            let current = this.getCurrent();
            return current > 1;
        },
        nextPage(){
            let current = this.getCurrent();
            return current + 1;
        },
        nextPageActive(){
            let current = this.getCurrent();
            let last = this.getLast();
            return current < last;
        }
    }
}
</script>
