
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('../components/Example.vue'));
//Passport Vue
Vue.component(
    'passport-clients',
    require('../components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('../components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('../components/passport/PersonalAccessTokens.vue')
);

var backurl = "http://laravel.54.com:5000"
//

const app = new window.Vue({
     el: '#layout-app',
     data : {
         message : 'hello, test Message!',
         backurl : backurl,

         clientName : 'jackTest',
         clientRedirect : 'http://ecshop.local',
     },

     filters : {
         capitalize : function(value) {
             if(!value ) return '';

             value = value.toString();
             return value.charAt(0).toUpperCase() + value.slice(1);
         }
     },
        methods : {

            create : function(){
                console.log('create client')
                data = {
                    name : this.clientName,
                    redirect : this.clientRedirect
                }
                axios.post('/oauth/clients',data)
                    .then(function(response){
                        console.log(response.data)
                    })
                    .catch(function(response){
                        console.log(response)
                    })
            },
            update : function(){
                data = {
                    name : this.clientName,
                    redirect : this.clientRedirect
                }
                axios.put('/oauth/clients/' + this.clientId , data)
                    .then(function(response){
                        console.log(response)
                    })
                    .catch(function(response){
                        console.log(response)
                    })
            },
            deletes : function () {
                axios.delete('/oauth/clients/' + this.clientId)
                    .then(function (response) {
                        console.log(response)
                        this.clientResponse = response
                    })
                    .catch(function (response) {
                        console.log(response)
                        this.clientResponse = response
                    })
            },
            getUser : function() {
                axios.get('/api/user', {
                    headers : {
                        'Content-Type' : 'application/json',
                        'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBhNGE5NjY2ZmMwOTQ3NDliNzk0YjkxOTkzNDdhZDk1M2JhNDIzZmI5MWYxOTdlMjFkMThiM2NkNzc3MDQwZGQ2MDE3YWFjY2E3MTgwMWNlIn0.eyJhdWQiOiIyNyIsImp0aSI6IjBhNGE5NjY2ZmMwOTQ3NDliNzk0YjkxOTkzNDdhZDk1M2JhNDIzZmI5MWYxOTdlMjFkMThiM2NkNzc3MDQwZGQ2MDE3YWFjY2E3MTgwMWNlIiwiaWF0IjoxNDkzMzg3NjkyLCJuYmYiOjE0OTMzODc2OTIsImV4cCI6MTQ5NDY4MzY5Miwic3ViIjoiNiIsInNjb3BlcyI6WyIqIl19.boBMC32qktU2yok38xcU-ATDKd0vgj9XHNF09nMRR5luGPgIrGcbzYmgzTWmqta8_NBVfwKodqv4nLs6QtzoaCHlQviRF0XP7auAO_Y3fHwvFrDLnOopk0hnbfwLXYFkbCt0e6srck-p-Stw6aM8XZtRk4X4_7Rts_tkQFTTNRefD5nXbX7j_oUGryYvi4dzFkrBCTjhQ7Eza2SQKIceixPkJYiv-zqqVgvahWxEkDslNaF_ARYFbQP9kOEr3PAahE8533Tv7SlrYXdwe0XlwO40bMEHy2Sk7qST4MSPdn7OAJbjzbdJYBp16SVMzHYEslR7MtV-SmvHYntBLgmoNzODlneWfSNSCoI_LWJTXJDSXeWd_pGTUxCFA5RXPFNR_ywHfkRxLjCh6Q-ynWesPNuYzmfKq7NsTuxmCN59KOF1irbf7UrbNvbz6TjM1LfuPftiEr15e9err6cCPk8wZOBIlHo3c9KSBhglKoWEdf5Vm3QNsU_D_8vvHrCv72gaT_STaJ7LlQVQuAwt4tBniSxOrMKxvKS1xUEd6EMNiVmiRUWGHHDzRxz9CGbCoJJOBx6uIoGpKid7YQc3vGiPoO0GqbAJLGoG4no_vgkWQq5XbPNmdCK-e1pXAXzyb_8Kab4-1fV3FR__dHj0p-qChVTSDa9squAD2eo0U0y3CAg'
                    }
                })
                    .then(function (response) {
                        console.log(response)
                        this.clientResponse = response
                    })
                    .catch(function (response) {
                        console.log(response)
                        this.clientResponse = response
                    })
            }

        }
});

axios.get('/oauth/clients')
    .then(function(response){
        console.log( 'oauth/clients:' + response.data)
    })

