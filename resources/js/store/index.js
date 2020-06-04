import axios from 'axios';
const BASE_API_URL = 'http://www.mocky.io/';


const API = axios.create({
    baseURL: String(BASE_API_URL),
    timeout: 30000,
    headers: {
        "Content-Type": "application/json"
    }
});



export default {



    state: {

        dados: ''

    },

    getters: {

        getCategoryFormGetters(state) { //take parameter state

            return state.dados
        }
    },

    actions: {

        allCategoryFromDatabase(context) {
            const API_IP_ENDPOINT = "v2/5ed7144932000035002744d0";
            
            API.get(API_IP_ENDPOINT)
                .then(response => {
            console.log(response);
            context.commit("dados", response.data.hello); //categories will be run from mutation
        }).catch(() => {

                    console.log("Error........")

                })
        }
    },

    mutations: {
        dados(state, data) {
            return state.dados = data
        }
    }
}