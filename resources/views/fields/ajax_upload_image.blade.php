<?php
$options['value'] = $options['value'] ? $options['value'] : old($name);
$src = \App\Http\Helpers\HostHelper::getImage($options['value']);

$labelText = '';
switch ($name) {
    case 'thumb' :
        $labelText = '缩略图';
        break;
    default:
        break;
}
?>

<div class="form-group">

    <label for="title" class="control-label required">{{$labelText}}</label>

    <br/>

    <input type="file" data-id=""
           data-url="{{ route('upload_image') }}"
           data-directory = "{{ env('ARTICLE_THUMB_FILE_PATH') }}"
           data-show-img = true
           class="ajax_upload"
    />

    <input type='hidden' name="{{$name}}" value="{{$options['value']}}" class="UploadForm-ArticleId01"  />

    <img src="<?= $src?>"
         id="img-UploadForm-{$ajaxParamId}"
         class="ajax_upload_img" />
    <a class='del'>删除</a>

</div>



