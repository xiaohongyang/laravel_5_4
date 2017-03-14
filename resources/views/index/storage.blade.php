{{asset('storage/test.txt')}}
<br/>

<?php
        //Storage::put('a.txt', '321');
        //Storage::put("test.txt", "test test");
        //Storage::put("test.txt", "test test");
        //Storage::prepend('test2.txt', "prepend content ");
        //Storage::append("test2.txt", "apend content");
        //Storage::copy('test2.txt', 'test2_copy.txt');
        //Storage::move('test2_copy_2.txt', 'new.txt');
?>
<form method="post" enctype="multipart/form-data">

        <?=csrf_field()?>

        <input type="file" name="headpic">     <br/>
        <input type="submit">
</form>
<br/>
最后编辑日期：<?=date('Y-m-d H:i:s', Storage::lastModified("test2.txt"))?> <br/>

test2.txt的内容: <?=Storage::get('test2.txt')?> <br/>
test2_copy.txt的内容 : <?=Storage::get('test2_copy.txt');?>

<a href="<?=\Storage::disk('local')->url('test.txt')?>">test.txt</a>
<?php
        echo \Storage::size('test.txt');
        echo "<br/>";
        echo date('Y-m-d H:i:s', \Storage::lastModified('test.txt'));


        if(\Storage::exists('test2.txt')){
            echo '<br/>';
            echo date('Y-m-d H:i:s', \Storage::lastModified('test2.txt'));
        } else {
            \Storage::copy('test.txt', 'test2.txt');
        }

