<template>
    <div>
        <button v-on:click="increate()">{{btn_content}} {{counter }}</button>
        <hr/>
        <button v-on:click="say()"> say </button>
    </div>

</template>

<script>
    export default{
        data : function(){
            return  {
                counter  : 0,
                btn_content : 'hello'
            };
        },

        methods : {
            increate : function(){
                this.counter  += 1
            },
            say : function(){
                alert(333)
            }
        }
    }
</script>
