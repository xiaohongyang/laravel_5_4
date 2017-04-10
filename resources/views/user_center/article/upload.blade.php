<?php


$uploadUrl = '/douploadfile';
$delIcon = "删除";
$isShowDelBtn = true;
$fileDesc = '';
$fileType = 'img';
$uploadIdValue = 0;

$loadSrc = '/images/default-headpic.png';
$ajaxParamId = 'id';
$dataId = "ajax_data_id";
$fileDesc = is_null($fileDesc) ? '' : $fileDesc;
$fileType = is_null($fileType) ? '' : $fileType;
$uploadIdValue = !is_null($uploadIdValue) ? $uploadIdValue : '0';

$delBtnClass = $isShowDelBtn ? '' : 'hide';

$str = <<<STD
                                            <input id="{$ajaxParamId}"
                                                    name="UploadForm[{$ajaxParamId}]"
                                                    point-class="UploadForm-{$ajaxParamId}" type="file"
                                                    point-img="img-UploadForm-{$ajaxParamId}"
                                                    point-valueId-class = "value-{$ajaxParamId}"
                                                    data-url="{$uploadUrl}"
                                                    data-id ="{$dataId}"
                                                    class="ajax_upload form-control"
                                                    />

                                            <input type='hidden' class="file_desc" value="{$fileDesc}" />

                                            <input type='hidden' name="UploadForm[]" value="{$uploadIdValue}" class="value-{$ajaxParamId}"  />
                                            <img src="{$loadSrc}"
                                                id="img-UploadForm-{$ajaxParamId}"
                                                class="none ajax_upload_img"
                                                point-file-input="{$ajaxParamId}"
                                                load-src="{$loadSrc}" />

                                            <a class='del {$delBtnClass}'>{$delIcon}</a>
STD;
?>
<div class="btn-wrap">
                                <span class="btn">
                                    <?=$str?>
                                </span>
</div>


@section('scripts')
    {{ Html::script(mix('js/ajaxFileUpload.js')) }}

    <?php
        $btnClass = '.ajax_upload_img';
        $inputClass = '.ajax_upload';

        $objClass = $btnClass;
        $str = <<<STD

            <script type="text/javascript">

                $.fn.ajaxFileUpload = {

                    init : function(){

                       $.fn.ajaxFileUpload.bindUploadAction();
                       $(document).on("click",'{$btnClass}',function(){
                            //触发file input的点击事件
                            $("#"+$(this).attr('point-file-input')).trigger('click');
                       })

                       //删除上传的图片事件
                       $.fn.ajaxFileUpload.delEvent();
                    },

                    //data {id:id, url:url, otherData:otherData}
                    ajaxFileUpload : function(data){
                        var id = data.id;
                        var url = data.url;
                        var otherData = data.otherData?data.otherData:{};
                        var fileDesc = data.fileDesc
                        $.ajaxFileUpload ({
                            url: url,
                            secureuri:false,
                            fileElementId:id,
                            dataType: 'json',
                            data:{_csrf: window.Laravel.csrfToken,'fileDesc':fileDesc, id:otherData},
                            success: function (data)
                            {

                                if(data.status==1){
                                    var file_name = data.data.file_name;
                                    var objClass = $('#'+id).attr('point-class');
                                    var showImageId = $('#'+id).attr('point-img');
                                    var pointValueId = $('#'+id).attr('point-valueId-class');

                                    $('.'+objClass).val(file_name);
                                    $('#'+showImageId).attr('src', data.data.img_src).show();
                                    $('.'+pointValueId).val(data.data.upload_id);

                                    $('#'+showImageId).next('.del').css('display','inline-block');
                                }else{
                                    alert(data.message)
                                }
                                return false;

                            },
                            error: function (data, status, e)
                            {
                               alert(e);
                            }
                        });

                        return false;
                    },

                    onFileChange : function(obj){
                        var id = obj.attr('id');
                        var url = obj.attr('data-url');
                        var otherData = {name:id};
                        var fileDesc = obj.parent().find('.file_desc').val();
                        var data = {id:id, url:url,fileDesc:fileDesc,  otherData:otherData};
                        $.fn.ajaxFileUpload.ajaxFileUpload(data);
                    },

                    bindUploadAction : function(){
                        var objClass = '{$inputClass}';
                        $(document).on("change",objClass,function(){//修改成这样的写法
                            $.fn.ajaxFileUpload.onFileChange($(this))
                        });
                    },

                    delEvent : function(){
                        $(document).on("click",' .del',function(){
                            //触发file input的点击事件
                            if($(this).prev('{$btnClass}').length>0){

                                var fileInputObj = $(this).parent().find('input').eq(0);
                                fileInputObj.val('');

                                var valueInputClass = $(this).parent().find('input').eq(0).attr('point-valueId-class');
                                $('.'+valueInputClass).val('');
                                var src= $(this).prev('$btnClass').attr('load-src');
                                $(this).prev('$btnClass').attr('src',src)
                                $(this).hide();
                            }
                       })
                    }
                }

            var ajaxFileUpload = $.fn.ajaxFileUpload;
            ajaxFileUpload.init()
            </script>
STD;
        $strBindEvent = <<<STD
STD;
        echo $str . $strBindEvent;
    ?>
@endsection