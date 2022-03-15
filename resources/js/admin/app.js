import { createApp } from "vue";
import axios from "axios";
import App from "./App.vue";
import router from "./router";
import * as helper from "./libs/helper";
import headers from "./libs/headers";
import alertToast from "./libs/alertToast"
import title from "./libs/title";
import Content from "./components/Content.vue";
import BsTable from "./components/BsTable.vue";
import RecordInfo from "./components/RecordInfo.vue";
import RecordNumb from "./components/RecordNumb.vue";
import RecordPage from "./components/RecordPage.vue";
import Search from "./components/Search.vue";
import Modal from "./components/Modal.vue";
import ModalForm from "./components/ModalForm.vue";
import ButtonSimpan from "./components/ButtonSimpan.vue";
import ButtonUpdate from "./components/ButtonUpdate.vue";
import ButtonEdit from "./components/ButtonEdit.vue";
import ButtonDelete from "./components/ButtonDelete.vue";
import ButtonHapus from "./components/ButtonHapus.vue";
import ButtonBatal from "./components/ButtonBatal.vue";
import FormInput from "./components/FormInput.vue";
import FormInputFile from "./components/FormInputFile.vue";
import FormSelect from "./components/FormSelect.vue";
import FormTextarea from "./components/FormTextarea.vue";
import TrEmpty from "./components/TrEmpty.vue";
import ProgressBar from "./components/ProgressBar.vue";
import SmallBox from "./components/SmallBox.vue";

// app
const app = createApp(App)
// properties
app.config.globalProperties.$config = config;
app.config.globalProperties.$http = axios;
app.config.globalProperties.$url = helper.url;
app.config.globalProperties.$api = helper.api;
app.config.globalProperties.$ucwords = helper.ucwords;
app.config.globalProperties.$errorResponse = helper.errorResponse;
app.config.globalProperties.$can = helper.can;
app.config.globalProperties.$hasWalikelas = helper.hasWalikelas;
app.config.globalProperties.$title = title;
app.config.globalProperties.$headers = headers;
app.config.globalProperties.$toast = alertToast;
// components
app.component('Content',Content);
app.component('BsTable',BsTable);
app.component('RecordInfo',RecordInfo);
app.component('RecordNumb',RecordNumb);
app.component('RecordPage',RecordPage);
app.component('Search',Search);
app.component('Modal',Modal);
app.component('ModalForm',ModalForm);
app.component('ButtonSimpan',ButtonSimpan);
app.component('ButtonUpdate',ButtonUpdate);
app.component('ButtonEdit',ButtonEdit);
app.component('ButtonDelete',ButtonDelete);
app.component('ButtonHapus',ButtonHapus);
app.component('ButtonBatal',ButtonBatal);
app.component('FormInput',FormInput);
app.component('FormInputFile',FormInputFile);
app.component('FormSelect',FormSelect);
app.component('FormTextarea',FormTextarea);
app.component('TrEmpty',TrEmpty);
app.component('ProgressBar',ProgressBar);
app.component('SmallBox', SmallBox);
// setup
app.use(router);
app.mount('#app');
