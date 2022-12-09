<script>
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var mainId = $(this).parents('.main-media-parent').attr('id').replace(/[^\d.]/g,'');
        if(mainId>0){
            $('#catf_'+mainId).find('.pagination').find('li').removeClass('active');
            $(this).addClass('active');
            var url = $(this).attr('href');
            page = $(this).attr('href').split('page=')[1];

            $.get("{{url('backoffice/product/sendimg')}}",{'id':mainId,page:page},function(n){
                $('#media-dybox').find('.tab-content').find('#catf_'+mainId).html(n.data);
            });
        }
    });

    $('.media-tabs').on('click',function(){
        var id = $(this).find('a').attr('data-id');
        if(id>0){
            var content = $('#media-dybox').find('.tab-content').find('#catf_'+id).html();
            if(content==""){
                $.get("{{url('backoffice/product/sendimg')}}",{'id':id},function(n){
                    $('#media-dybox').find('.tab-content').find('#catf_'+id).html(n.data);
                });
            }
        }
    });

    var iterator = 0;

    $(document).on("click","#img-cross", function(){
        $(this).parent('#add-image').parent('.col-2').remove();
    });

    function load_media(id){
        $('input[type="checkbox"][id^="myCheckbox"]').prop('checked', false);
        $('.take-image-modal').modal('show');
        iterator = id;
    }



    $(document).on('click','input[type="checkbox"][id^="myCheckbox"]',function() {
    $(`#merge-image-${iterator}`).html();
        var id = $(this).attr('id');
        var imagesrc = "{{asset('file')}}"+ "/"+$(this).attr('data-img');
        var name = $(this).attr('data-img');
        var html = '';
        console.log(name.split('.')[1]);
        if (this.checked) {
            var url = iterator + name;
            let data = url.split('.')[0];
            if (name.split('.')[1] == 'mp4' || name.split('.')[1] == 'omg' || name.split('.')[1] == 'wmv' || name.split('.')[1] == 'mpg' || name.split('.')[1] == 'webm' || name.split('.')[1] == 'ogv' || name.split('.')[1] == 'mov' || name.split('.')[1] == 'asx' || name.split('.')[1] == 'mpeg') {
                html += `<div class="col-2" id="${data}">
                        <div class="border p-2"  id="add-image">
                            <i class="fa fa-times" style="" id="img-cross"> </i>
                            <video onerror="handleError(this);" class="box-images px-2 py-2" height="150px;" title="Video - ${name}" controls="">
                                <source src="${imagesrc}">
                            </video>
                            <input type="hidden" id="image" name="gallery[${iterator}][]" value="${name}">
                        </div>
                    </div>`;
            } else {
                html += `<div class="col-2" id="${data}">
                        <div class="border p-2"  id="add-image">
                            <i class="fa fa-times" style="" id="img-cross"> </i>
                            <img onerror="handleError(this);"src="${imagesrc}" class="w-100" style="height : 150px;">
                            <input type="hidden" id="image" name="gallery[${iterator}][]" value="${name}">
                        </div>
                    </div>`;
            }
            

            $(`#before-btn-${iterator}`).before(html);
            toastr.success('Success', 'Image added successfully.',{
                positionClass: 'toast-top-center',
            });
        }
        else{
            var url = iterator + name;
            let data = url.split('.')[0];
            $(document).find(`#${data}`).remove();
                    toastr.error('Error', 'Image remove successfully.',{
                    positionClass: 'toast-top-center',
            });
        }
    });




Dropzone.autoDiscover = false;
$(document).on('click',"#image-upload", function(){
    var drop = new Dropzone("#image-upload",{
        maxFilesize: 5,
        url: "{{ route('admin.media.popstore') }}",
        acceptedFiles: ".jpeg,.jpg,.png,.gif,video/*",
        addRemoveLinks: true,
        timeout: 50000,
        thumbnail:function(file,url){
            console.log('esfe', file.type);
            if($('.reszeit').length>0){
                console.log(file);
                console.log(file.width);
                if(file.height<1500 || file.width<1000){
                    console.log('1');
                    file.rejectDimensions();
                }else{
                    console.log('2');
                    file.acceptDimensions();
                }
            }else{
                console.log(file.type);
                if (file.type == 'video/mp4') {
                    if(file.size/1024 > 5120){
                        return false
                    } else {
                        file.acceptDimensions();
                    }
                } else {
                    if(file.size/1024 > 1024){
                        return false
                    } else {
                        file.acceptDimensions();
                    }
                }
            }
        },
        success: function(file,response){
            console.log(response);
            if(response.success){
                var data = response.data;
                if (file.type == 'video/*') {
                    var html = `<div class="col-xs-4 col-md-2 margin-bottomset py-2">
                        <div class="img-thumbnail thumbnail-imgess">
                            <input type="checkbox" id="myCheckbox${data.id}" data-id="${data.id}" data-img="${data.name}"/>
                              <label for="myCheckbox${data.id}" id="myLabel${data.id}">
                                <img onerror="handleError(this);"class="box-images px-2 py-2" image_id="" title="Video - ${data.name}" src="{{asset("file")}}/${data.name}" alt="..." >
                                <video controls poster="{{asset('assets/images/video.png')}}" class="w-100" style="height : 150px;">
                            </label>
                        </div>
                    </div>`;
                } else {
                    var html = `<div class="col-xs-4 col-md-2 margin-bottomset py-2">
                        <div class="img-thumbnail thumbnail-imgess">
                            <input type="checkbox" id="myCheckbox${data.id}" data-id="${data.id}" data-img="${data.name}"/>
                              <label for="myCheckbox${data.id}" id="myLabel${data.id}">
                                <img onerror="handleError(this);"class="box-images px-2 py-2" image_id="" src="{{asset("file")}}/${data.name}" alt="..." >
                            </label>
                        </div>
                    </div>`;
                }
                $(document).find('#media-dybox').find('#unctg').find('.row').append(html);
            }
        },
        error: function(file, message)
        {
            console.log(message);
            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message);
            return false;
        }
     });

    //  drop.on('accept', function(file, done){
    //     drop.on("thumbnail", function(file){
    //         if($('.reszeit').length>0){
    //             console.log(file);
    //             console.log(file.width);
    //             $.each(file,function(v,n){
    //                 console.log(v);
    //                 console.log(n);
    //             });
    //             if(file.height<1200 || file.width<1000){
    //                 return done('File Height must be greater than 1200 & width must be greater than 1000');
    //             }else{
    //                 return done();
    //             }
    //         }else{
    //             return done();
    //         }
    //     });
    // });

});
</script>
