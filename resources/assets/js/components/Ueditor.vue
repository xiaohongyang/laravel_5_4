<template>
    <div>
        <script id="container" name="content" type="text/plain">{{value}}</script>
    </div>
</template>


<script>
    export default {
        props : ['value'],
        data : function(){
            return {
                myValue : this.value
            }
        },
        mounted :function () {
            var t = this
            this.ue = UE.getEditor('container');
            this.ue.ready(function() {
                //this.ue.execCommand('serverparam', '_token', '321321');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
            });
            this.ue.addListener("selectionchange", function(){
                t.myValue = t.ue.getContent()

            })
        },
        watch : {
            myValue : function(newValue, oldValue) {
                console.log('newVallue:' + newValue)
                this.$emit('on-contents-change', newValue)
            }
        }
    }
</script>