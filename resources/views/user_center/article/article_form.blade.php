<form class="form-horizontal" action="{!! route('article-create') !!}" method="post">

    {{csrf_field()}}

    <div class="form-group">
        <div class="row">

        <div class="input-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <span class="input-group-addon " for="title">title</span>
            <input type="text" class="form-control" placeholder="please enter title" name="title" />
        </div>



        <div class="input-group">
            <input type="submit" class="btn btn-primary" value="提交">
        </div>

    </div>


</form>