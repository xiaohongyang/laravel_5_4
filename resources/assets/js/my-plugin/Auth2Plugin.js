var Toast = {};
Toast.install = function (Vue, options) {
    Vue.prototype.$msg = 'Hello World';
    Vue.prototype.$authToken = function(){
        var token = window.localStorage.getItem('token');
        if(token){
            console.log(token)
            return token;
        }
        else {
            axios.get('/passwordToken')
                .then(function(json){
                    console.log(access_token)
                    if(json.data.access_token)
                        window.localStorage.setItem('token', json.data.access_token)
                })
        }
    }
    Vue.prototype.$freshToken = function(){

        axios.get('/passwordToken')
            .then(function(json){
                console.log(json)
                if(json.data.access_token)
                    window.localStorage.setItem('token', json.data.access_token)
            })
    }
}

module.exports = Toast;
