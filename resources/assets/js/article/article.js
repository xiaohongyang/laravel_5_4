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
    t : this,
    el : '#layout-app',
    data : {
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
                    'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5YmIxM2ExYjU0ZmIzYTI0MjFlMWQzNWM2YzRiMDgxYzQ5NWI1NTgzNTEzOWY3NjViZThhNjQ3ZmNlMTQ3YTdhZDAwYmJiMTQ0ZGJlMWJiIn0.eyJhdWQiOiI1IiwianRpIjoiYzliYjEzYTFiNTRmYjNhMjQyMWUxZDM1YzZjNGIwODFjNDk1YjU1ODM1MTM5Zjc2NWJlOGE2NDdmY2UxNDdhN2FkMDBiYmIxNDRkYmUxYmIiLCJpYXQiOjE0OTU5NzY2NjAsIm5iZiI6MTQ5NTk3NjY2MCwiZXhwIjoxNDk3MjcyNjYwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.WRS8v0bw_XMsJ5-ozD0uIKrX2lEoJLZt5RLdfQU4E1QB8IEu-R50IYPyK893U30DJ42uxYJ1YBg07Vs-DeGTpeYbaxoRa-sk1isbCJSwrgK6C-efJM80Q0fZpCgakdh5S8RG5OaVGaCiA1jLN1YNNdWKjr2bS5I2sBA1xUKTzcq8pUlzZkduyA_v3Ce7fL4yxE_Gl7szt_cIVAkFm0iM5TkXyiZDHIams565bJ6EmtVgLxNCjZlNtwd_VQQ-eXWNtV8Ivmv21iV01UhOWFAd5QMJWj8_mHhJy08JhkUghLOajvkPOwD1bD4Cxk3YAGuPPI9k0wAFcaihW33LXWcrZQ56Y0htOtrX4JZu5QzEX-9Ajt43isT_r1gbRVHVFVbQc6DjELcoBMpAu38iRmu78eMJcVqpXx-u0-_Hsm4-T9zTv8kMIzALS2UPLfKphIWMb9IAmsbdxsGc9WYL1vkmaqO19wQIkkp5_7PH4Db1R3y9znJL1_vH8w3FyhepJ1oWFTQzc8aMYUmT2ikXi3XltZ2wVKxeA0clwmo8mKQ2yXwC6F-SXbJ0FmurBU0pTtmNvqAsMMFKrcOMfJTMmZr7NcJt-NS7oR2chUUFNIKx_V_TT6AvZ5wE4xUc0X4ZpuJtCwY3j2wZyjAaGPwFUVyZelmy4Vd3w-1YXVLO4-3GE9E'
                },
                params : {
                    page : page
                }
            })
                .then(function (response) {
                    console.log(response)
                    this.clientResponse = response
                    if (response.status == 200){
                        t.articleList = response.data.data
                        t.pagination.update(response.data.current_page)
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
        this.getPageData()
        console.log('created')
    }
})


  