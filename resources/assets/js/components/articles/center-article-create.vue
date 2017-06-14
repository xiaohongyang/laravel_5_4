<template>
    <div id="center-article-create">
        <div>
            <span> title </span>
            <span> <input type="text" id="title" v-model="title"   name="title"> </span>
            <span class="error"> </span>
        </div>
        <div>
            <span> pic </span>
            <span>
                <input type="file" id="thumb"  v-on:change="uploadFile()" />
                <img :src="thumbSrc"   style="width: 80px; height: auto"  />
            </span>
            <span class="error"> </span>
        </div>
        <div>
            <span> tag </span>
            <span> <input type="text" name="tag" v-model="tag" >  </span>
            <span class="error"> </span>
        </div>

        <script id="container" name="content" type="text/plain">
        </script>

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
                contents : '',
                ue : {}
            }
        },
        mounted : function(){
            var t = this
            this.ue = UE.getEditor('container');
            this.ue.ready(function() {
                //this.ue.execCommand('serverparam', '_token', '321321');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
            });
            this.ue.addListener("selectionchange", function(){
                t.contents = t.ue.getContent()
            })
        },
        computed : {
            thumbSrc : function(){
                return this.thumb ? this.$config.host.img_host + '/' + this.thumb : '';
            }
        },
        watch : {
            contents : function(newValue, oldValue) {
                console.log(newValue)
            }
        },
        methods : {
            //上传图片
            uploadFile : function(){

                var t = this
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$authToken()
                var data = new FormData();
                var thumb = document.getElementById('thumb').files[0]

                data.append('thumb', thumb);
                data.append('directory', this.$config.directory.article_directory);


                axios.post('/api/upload_image', data )
                    .then(function(json){
                        console.log(json)
                        if(json && json.data.file) {
                            t.thumb = json.data.file
                        }
                    })
            },
            submit : function(){
                var data = {
                    title : this.title,
                    thumb : this.thumb,
                    contents : this.contents
                }

                axios.post(this.$config.url.api.article_store, data)
                    .then(function(json) {
                        console.log(json)
                    })
            }
        },
        complete : function(){
        },
        beforeMount : function(){
            this.$authToken()
            this.$freshToken()
        },
        created : function(){

        }
    }

</script>