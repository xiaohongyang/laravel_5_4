<form action="{{route('photos.store')}}" method="post">

    {{csrf_field()}}
    <input type="text" name="name" >

    <input type="submit" value="submit"/>

</form>