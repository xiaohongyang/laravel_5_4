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

        <Ueditor v-bind:value="contents" @on-contents-change="onContentsChange"></Ueditor>

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
                contents : '32132',
                ue : {}
            }
        },
        mounted : function(){

        },
        computed : {
            thumbSrc : function(){
                return this.thumb ? this.$config.host.img_host + '/' + this.thumb : '';
            }
        },
        watch : {
            contents : function(newValue, oldValue) {
                console.log("contents:" + newValue)
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
            },
            onContentsChange : function(val) {
                this.contents = val
                console.log(val)
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