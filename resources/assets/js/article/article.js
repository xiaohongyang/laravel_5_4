const app2 = new Vue({
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
});

const appList = new Vue({
    el : '#list',
    methods : {
        getList : _.debounce(function () {

            axios.get('/')
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                })

        },500)
    },
    created : function() {

        this.getList()
    }
})
