
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');


/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
import Ueditor from './components/Ueditor.vue'
Vue.use(Ueditor)
import Auth2Plugin from './my-plugin/Auth2Plugin'
Vue.use(Auth2Plugin)
import ConfigPlugin from './my-plugin/ConfigPlugin'
Vue.use(ConfigPlugin)

Vue.component('Ueditor', require("./components/Ueditor.vue"))

Vue.component('xhy-hello', require("./components/articles/center-article-create.vue"))
Vue.component('center-article-create', require("./components/articles/center-article-create.vue"))


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

 import Echo from "laravel-echo"

/* window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'ca78de93c3a612137745',
    //cluster: 'eu',
    //encrypted: true
 });

var id = 3;
window.Echo.private('chat-room.'+ id)
    .listen('ChatMessageWasReceived', (e) => {
        console.log(e)
});*/

//window.Echo.private('article')
//    .listen('ArticleStatusUpdated', (e) => {
//        console.log(e)
//    });



// var echo = window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host : window.location.hostname + ":6001"
//     //cluster: 'eu',
//     //encrypted: true
// });

//listen sisten redis publish event by laravel-echo-server
// echo.channel("chat-room")
//     .listen("ChatMessageWasReceived", function(e){
//         console.log(e)
//     })

// echo.private("chat-room")
// .listen("ChatMessageWasReceived", function(e) {
//     console.log(e)
// })