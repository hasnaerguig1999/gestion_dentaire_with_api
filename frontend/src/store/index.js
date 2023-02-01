import {createStore} from "vuex";
import router from "../router/index"
const state={};
const getters={};
const mutations={
    redirect(){
        console.log('hello');
    }
};
const actions={
    redirect({commit},payload){
        commit('redirect',payload.val);
        router.push({name:payload.val});

    }
};
const modules={};
export default createStore({
    state,
    getters,
    mutations,
    actions,
    modules,
});