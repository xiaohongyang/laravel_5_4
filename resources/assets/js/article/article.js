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
    el : '#layout-content',
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
                    'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFiNjE5MmEwYzQyMmQ3NDllODU2YzdhNTA1YWNiYWEzZDc1YmI5ZTJkZjJkMzBjNzczN2EyZGEzMzcxYTI5ZTYwNmI0OTI5YTY4MzBlMjYzIn0.eyJhdWQiOiIyOCIsImp0aSI6ImFiNjE5MmEwYzQyMmQ3NDllODU2YzdhNTA1YWNiYWEzZDc1YmI5ZTJkZjJkMzBjNzczN2EyZGEzMzcxYTI5ZTYwNmI0OTI5YTY4MzBlMjYzIiwiaWF0IjoxNDkzNzAyNDM2LCJuYmYiOjE0OTM3MDI0MzYsImV4cCI6MTUyNTIzODQzNiwic3ViIjoiNCIsInNjb3BlcyI6W119.CZWe4z-reK1_WEAef1Rp96RqGNkoQamirLwWtiVRSlfFRtC5wCqurw5A6vxg32lRQRgcs6x_tiDURz-Xd3ouTJCniO87PFWml51XgaxcnRaJLAHEPfDC7pTZnN9NCBtxdsZ3No3CrHJjDIXihvAqmcb-h7xn3x1Ckncqo8v35T-ftwIBJJPlqNjOv8qW6IOhf0_2W4Bi_EMg0VRVLuLc8DwIUG47vhPB-U8mTE5N8K31gIYuc7xJqvs-6AbL5RIzJD3ZHaljm9W3oMLGCanE40NAljXd5t_uICRo8cy_mUl1pLvBD1aCGD8MR0tj0ZzbA6wTRPV1wS3Tk5aseNBeeGO1GQZ-eEJgFGDdZ9cvepTmSIlAt3WzPBO6ldXzSGfq-yeHk4mgVr9W6CbUnr8OWhrM44C-IkpW1RmJVBcE04KV-CowYSYgng4C7eOYSHc_EqoFZ-qxr2z2e-ONkzYiK5BR6Q0Sa44b7OIz1BRtjDZ1eihme6D4cyzWWGakAUgN2kM6Ra1FzyaPnMaOgvqCxUHZWoooF7bMSQbkqOReRbFJRHHAMFSt3jZAL1QE7PsBGoK5eoAkSuc3w2c1dKp65Zblq_k1V8J8wAjl95Bzm4gSqxEy1PTHJEWYJ1Lpl0xGwGNbrs_sVrQBUETx6Q9-AVu54GwDJ3iJwkqAFNi7M0M'
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


  