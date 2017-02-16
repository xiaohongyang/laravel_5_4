<?php

?>

<form type="/route" method="post" >
    {{ csrf_token() }}

     <input type="file"  name="photo"  />  <br/>

    <input type="submit" name="提交">

</form>
