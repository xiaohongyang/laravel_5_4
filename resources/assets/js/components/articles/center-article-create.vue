<template>
    <div id="center-article-create">
        <div>
            <span> title </span>
            <span> <input type="text" id="title" v-model="title"  name="title"> </span>
            <span class="error"> </span>
        </div>
        <div>
            <span> pic </span>
            <span> <input type="file" name="thumb"  v-on:change="uploadFile()" />  </span>
            <span class="error"> </span>
        </div>
        <div>
            <span> tag </span>
            <span> <input type="text" name="tag" v-model="tag" >  </span>
            <span class="error"> </span>
        </div>
        <div>
            <span> content </span>
            <span> <textarea name="content" v-model="content"></textarea></span>
            <span class="error"> </span>
        </div>

        <div>
            <span>
                <button v-on:click="submit()">提交</button>
            </span>
        </div>
    </div>
</template>


<script>
    export default {
        data : function(){
            return {
                token : '',
                title : '',
                thumb : '',
                tag : '',
                content : ''
            }
        },
        methods : {
            uploadFile : function(){
                this.thumb = 'test file'
            },
            submit : function(){
                console.log(this.thumb)
                console.log(this.title)
                var t = this
                var fn = function(){
                    alert(t.token);
                }
                this.getToken(fn)
            },
            getToken : function(fn){
                var t = this
                axios.get('/getToken')
                    .then(function(json){
                        console.log(json)
                        console.log(json.data.token)
                        t.token = json.data.token
                        fn()
                    })
            }
        },
        complete : function(){
            alert(321)
        }
    }
</script>