/*const app2 = new Vue({
    el: '#layout-content',
    data : {
        messageaa : 'hello, test Message!321'
    },
    filters : {
        revertString : function(value) {
            if(!value ) return '';

            value = value.toString();
            return value.charAt(0).toUpperCase() + value.slice(1);
        }
    },
    methods : {
        revertString : function() {
            this.messageaa = this.messageaa.split('').reverse().join('');
        }
    }
});*/

var appList = new window.Vue({
    el : '#layout-app',
    methods: {
        checkOrCancelAll: function (message) {

            if (event.target.checked) {
                $('.selectArticle').each(function(){
                    if(!$(this).checked) {
                        $(this).prop("checked", true);
                    }
                })
            } else {
                $('.selectArticle').each(function(){
                    if($(this)[0].checked) {
                        $(this).trigger('click')
                    }
                })
            }

        }
    }       
})


  