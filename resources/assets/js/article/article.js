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
/*

var appList = new window.Vue({
    t : this,
    el : '#app',
    data : {
        accessToken : '',
        articleList : {},
        pagination : {
            currentPage : 1,
            nextPage : null,
            prevPage : null,
            update : function (currentPage) {
                t.pagination.currentPage = currentPage
                if (currentPage > 1)
                    t.pagination.prevPage = currentPage - 1
                else
                    t.pagination.prevPage = 0
                t.pagination.nextPage = currentPage + 1
                //console.log(t.pagination)
            }
        }
    },
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
        },
        goNextPage : function(){
            t.getPageData(t.pagination.nextPage)
        },
        goPrevPage : function(){
            t.getPageData(t.pagination.prevPage)
        },
        getPageData : function(page){
            axios.get('/api/articles', {
                headers : {
                    'Content-Type' : 'application/json',
                    'Authorization' : 'Bearer ' + this.accessToken
                },
                params : {
                    page : page
                }
            })
                .then(function (response) {
                    console.log(response)
                    this.clientResponse = response
                    if (response.status == 200){
                        t.articleList = response.data.data.data
                        t.pagination.update(response.data.data.current_page)
                    }
                    else
                        t.articleList = {}
                })
                .catch(function (response) {
                    console.log(response)
                    this.clientResponse = response
                })

            t = this
        }
    } ,
    created :  function(){

        var t = this
        axios.get('/passwordToken').then(function(response){
            console.log(response);
            if(response && response.status==200)
                t.accessToken = response.data.access_token
            t.getPageData();
        })
        console.log('created')
    }
})


  */
