var url = "store";
var path_to_follow =window.location.origin+"/s1/";

var product_filter= [];
var system_filter= [];


var product_filter_h= [];
var system_filter_h= [];

var tools_filter_h =[];
var unselected_tools=[];
var cat_filter_h = [];


var fd = new FormData();

$(function() {
     
    
    
    // preventing page from redirecting
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(".upload-msg").text("Drag here");
        $('.upload-area').addClass("drag-msg");
        $('.upload-area').removeClass("upload-msg-active");
    });
 
    // Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".upload-msg").text("Drop");
        $(this).addClass("dragenter");
        $(this).removeClass("upload-msg-active");
        $(this).removeClass("drag-msg");
    });

    // Drag over
    $('.upload-area').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".upload-msg").text("Drop");
        $(this).addClass("dragenter");
        $(this).removeClass("drag-msg");
        $(this).removeClass("upload-msg-active");
    });

    // Drop
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
        console.log("on drop");
        $(".upload-msg").text("Uploading...");
        $(this).removeClass("dragenter");
        $(this).removeClass("upload-msg-active");
        $('.upload-area').addClass("upload-msg-active");
        var file = e.originalEvent.dataTransfer.files;
        //var fd = new FormData();

        fd.append('file', file[0]);

        //uploadData(fd);
    });

    // Open file selector on div click
    $("#uploadfile").click(function(){
        $("#file").click();
    });

    // file selected
    $("#file").change(function(){
        //var fd = new FormData();

        var files = $('#file')[0].files[0];

        fd.append('file',files);

       // uploadData(fd);
    });

    $("#upload_template").on("click",function(){
        console.log(fd);
        var category = $('select[multiple]').val();
        console.log(category.join(","));
        fd.append("category",category.join(","))
        uploadData(fd);

    });


    $('form.edit_template').on('submit', function (e) {

        e.preventDefault(); 
        var dataString = 'template_name='+ $('.template-name-edit').val() + '&description=' + $('.editable-temp-disc').val() + '&t_id='+ $('#t_id').val();
        $.ajax({
          type: 'post',
          url: 'post.php',
          data: dataString,
          success: function (response) {
            console.log('form was submitted');
            console.log(response);
            // if(window.location.host=="localhost"){
            //     //window.location.replace(window.location.origin+"/marketplace-new_copy/manage_templates.php");
            //     window.location.replace(window.location.origin+"/"+url+"/manage_templates.php");
            // }else {//if(window.location.host)
            //     window.location.replace(window.location.origin+"/Ether/manage_templates.php");
             
            // }
            window.location.replace(path_to_follow+"manage_templates.php");
          }
        });

    });

    //$('.edit-template-name h2').click(divClicked);
    $('.template-name-edit').click(divClicked);
    $('.editable-temp-disc').click(divClicked);

    // $('#checkAll').click(function () {    
    //     $(':checkbox.tpl_chk').prop('checked', this.checked);    
    // });
    
    $('.tpl_chk').on('change', function() {
        if($(this). prop("checked") == true){
            $('#delete').removeClass('disable');
        }
        else if($(this). prop("checked") == false){
            $('#delete').addClass('disable');
        }
        
        $('.tpl_chk').not(this).prop('checked', false);
        
      });

    $('#delete').click(function(){
        console.log('delete1111');
        var selected_tmp = [];
        $.each($(":checkbox.tpl_chk:checked"), function(){    
            console.log($(this).val());        
            selected_tmp.push($(this).val());
        });
        if(selected_tmp.length>0){
           
            var r = confirm("Do you want to delete the template?");
            if (r == true) {
                //alert("My favourite sports are: " + selected_tmp.join(", "));
                var dataString = "t_ids="+selected_tmp.join(", ");
                console.log(dataString);
                $.ajax({
                    type: 'post',
                    url: 'delete.php',
                    data: dataString,
                    success: function (response) {
                        //alert('form was submitted');
                        console.log(response);
                        if(response==1){
                            location.reload();
                        }
                    }
                });
            } else {
                //txt = "You pressed Cancel!";
                console.log('cancled');
            }

        }

            
    });

    $('.fil_product').on('change', function() {
        if ($(this).is(':checked')) {

            product_filter.push("'"+$(this).val()+"'");
            console.log( product_filter.join(", "));
            console.log(system_filter.join(", "))
            var dataString = "products="+product_filter.join(", ")+"&systems="+system_filter.join(", ");
            console.log(dataString);
            applyFilterManagepage(dataString);      
        }else{
            var index = product_filter.indexOf("'"+$(this).val()+"'");
            if (index > -1) {
                product_filter.splice(index, 1);
            }
            var dataString = "products="+product_filter.join(", ")+"&systems="+system_filter.join(", ");
            console.log(dataString);
            applyFilterManagepage(dataString);
        }
    });
   
    $('.fil_system').on('change', function() {
        if ($(this).is(':checked')) {

            
            system_filter.push($(this).val());
            console.log( system_filter.join(", "));
            console.log( product_filter.join(", "));
            var dataString = "systems="+system_filter.join(", ")+"&products="+product_filter.join(", ");
            console.log(dataString);
            applyFilterManagepage(dataString);   
        }else{
            var index = system_filter.indexOf($(this).val());
            if (index > -1) {
                system_filter.splice(index, 1);
            }
            var dataString = "products="+product_filter.join(", ")+"&systems="+system_filter.join(", ");
            console.log(dataString);
            applyFilterManagepage(dataString);
        }
    });

    $('#clear_all_manage').on('click',function(){
        $(':checkbox.fil_system').removeAttr('checked');
        $(':checkbox.fil_product').removeAttr('checked');
        // if(window.location.host=="localhost"){
        //     //window.location.replace(window.location.origin+"/marketplace-new_copy/manage_templates.php");
        //     window.location.replace(window.location.origin+"/"+url+"/manage_templates.php");
        // }else {//if(window.location.host)
        //     window.location.replace(window.location.origin+"/Ether/manage_templates.php");
         
        // }

        window.location.replace(path_to_follow+"manage_templates.php");
    });

    // home page filters
    // product 
    $('.fil_product_h').on('change', function() {
        if ($(this).is(':checked')) {

            product_filter_h.push("'"+$(this).val()+"'");
            console.log( product_filter_h.join(", "));
            console.log(system_filter_h.join(", "))
            var dataString = "tool_id="+product_filter_h.join(", ")+"&systems="+system_filter_h.join(", ");
            console.log(dataString);
            applyFilterHomepage(dataString);      
        }else{
            var index = product_filter_h.indexOf("'"+$(this).val()+"'");
            if (index > -1) {
                product_filter_h.splice(index, 1);
            }
            var dataString = "tool_id="+product_filter_h.join(", ")+"&systems="+system_filter_h.join(", ");
            console.log(dataString);
            applyFilterHomepage(dataString);
        }
    });

    // system
    $('.fil_system_h').on('change', function() {
        if ($(this).is(':checked')) {

            system_filter_h.push($(this).val());
            console.log( product_filter_h.join(", "));
            console.log(system_filter_h.join(", "))
            var dataString = "products="+product_filter_h.join(", ")+"&systems="+system_filter_h.join(", ");
            console.log(dataString);
            applyFilterHomepage(dataString);      
        }else{
            var index = system_filter_h.indexOf($(this).val());
            if (index > -1) {
                system_filter_h.splice(index, 1);
            }
            var dataString = "products="+product_filter_h.join(", ")+"&systems="+system_filter_h.join(", ");
            console.log(dataString);
            applyFilterHomepage(dataString);
        }
    });

    //tools
    $(document).on("change", ".fil_tool_home", function(){
        console.log("calledd---"+$(this).val());
        console.log( tools_filter_h.join(","));
        
        if ($(this).is(':checked')) {
            tools_filter_h.push($(this).val());
            console.log( tools_filter_h.join(","));
            console.log(cat_filter_h.join(","))
            var dataString = "tools="+tools_filter_h.join(",")+"&cats="+cat_filter_h.join(",")+'+"&filter_type=tool&type=check';
            console.log(dataString);
            //return false;
            applyFilterHomepage(dataString);      
        }else{
            console.log("not checked");
            console.log($(this).val());
            // remove the unchecked element from the checked array 
            var index = tools_filter_h.indexOf($(this).val());
            if (index > -1) {
                tools_filter_h.splice(index, 1);
            }
            console.log(tools_filter_h.join(","));
            console.log(cat_filter_h.join(","));
            unselected_tools.push($(this).val());
            var dataString = "tools="+tools_filter_h.join(",")+"&cats="+cat_filter_h.join(",")+'&type=uncheck';
            console.log(dataString);
            
            applyFilterHomepage(dataString);
        }
    });

    //categories
    $(document).on("change", ".fil_cat_home", function(){
            console.log("calledd---"+$(this).val());
            if ($(this).is(':checked')) {
                cat_filter_h.push($(this).val());
                console.log( tools_filter_h.join(","));
                console.log(cat_filter_h.join(","))
                var dataString = "tools="+tools_filter_h.join(",")+"&cats="+cat_filter_h.join(",")+"&filter_type=cat&type=check";
                console.log(dataString);
                applyFilterCatHomepage(dataString);      
            }else{
                console.log("not checked cat");
                console.log($(this).val());
                var index = cat_filter_h.indexOf($(this).val());
                if (index > -1) {
                    cat_filter_h.splice(index, 1);
                }
                console.log(cat_filter_h.join(","));
                console.log(tools_filter_h.join(","));
               
                var dataString = "tools="+tools_filter_h.join(",")+"&cats="+cat_filter_h.join(",");
                console.log(dataString);
                applyFilterCatHomepage(dataString);
            }
    });

    $('#clear_all_home').on('click',function(){
        window.location.replace(path_to_follow+"home.php");
    });


    $('form.search_manage').on('submit', function (e) {
        e.preventDefault(); 
       
        var dataString = 'searchstr='+ $('#search_field').val();
        console.log(dataString);
        $.ajax({
          type: 'post',
          url: 'search.php',
          data: dataString,
          success: function (response) {
            console.log('form was submitted');
            console.log(response);
            window.location.replace(path_to_follow+"manage_templates.php");
          }
        });

    });

    $('form.search_home').on('submit', function (e) {
        e.preventDefault(); 
       
        
        var dataString = 'searchstr='+ $('#search_field').val();
        console.log(dataString);
        $.ajax({
          type: 'post',
          url: 'search.php',
          data: dataString,
          success: function (response) {
            console.log('form was submitted');
            console.log(response);
            
            window.location.replace(path_to_follow+"home.php");
          }
        });

    });

    $(".download-btn a").on("click",function(){
        console.log($('#download_value').html());
        var current_code = parseInt($('#download_value').html());
        console.log(typeof(current_code));
        current_code= current_code+1;
        html_text='';
        if(current_code==1){
            html_text= " "+current_code+" download";
        }else{
            html_text= " "+current_code+" downloads";
        }
        setTimeout(function () {
            $('#download_value').html(html_text);
        }, 3000);
       
    })

    $(".download_template").on("click",function(){
        var t_id = $(this).attr("id");
        console.log(t_id);
        $.ajax({
            type: 'get',
            url: 'download.php?file='+t_id,
           // data: str,
            success: function (response) {
                //alert('form was submitted');
                console.log(response);
            }
        }); 
    });
    
    // search toolson home page
    $(document).on("keyup", "#search_tool_home", function(){
        var dataString = 'searchtoolstr='+ $('#search_tool_home').val()+'&filter_type=tool';
        console.log(dataString);
        loadfilter(dataString,"tool");
    });

    // search cat on home page
    $(document).on("keyup", "#search_cat_home", function(){
        var dataString = 'searchcatstr='+ $('#search_cat_home').val()+'&filter_type=cat';
        console.log(dataString);
        loadfilter(dataString,"cat");
    });

});
function divClicked() {

    var divHtml = $(this).text();
    console.log(divHtml);
    //console.log($(this).attr("class"));
    var editableText=$(this);
    editableText.focus();
    // setup the blur event for this new textarea
    editableText.blur(editableTextBlurred);
}

function editableTextBlurred() {
    var html = $(this).val();
    console.log(html+"  editable");
    
    //updateTemplateData();// to submit on onblur uncomment this
    // setup the click event for this new div
    //viewableText.click(divClicked);
    $(this).click(divClicked);
}

// Sending AJAX request and upload file
function uploadData(formdata){

    $.ajax({
        url: 'upload.php',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            console.log(response);
            console.log(response.status);
           
            if(response.status==1){
                // //addThumbnail(response);
                $(".upload-msg").text("Uploaded successfully");
                $('.upload-area').addClass("upload-msg-active");
                window.location.replace(path_to_follow+"preview.php");
            }else if (response.status==2){
                $(".upload-msg").text("File is not uploaded");
            }else if (response.status==3){
                $(".upload-msg").text("Only file with extension 'templatex' is allowed");
            }else if(response.status ==4){
                $(".upload-msg").text("No file found to upload");
            }
        }
    });

}

// Sending AJAX request and upload file
function updateTemplateData(){
    // console.log($('.template-name-edit').val());
    // console.log($('.editable-temp-disc').val());
    var dataString = 'template_name='+ $('.template-name-edit').val() +'&description='+$('.editable-temp-disc').val()+'&t_id='+ $('#t_id').val();
    console.log(dataString);
      
        $.ajax({
          type: 'post',
          url: 'post.php',
          data: dataString,
          success: function (response) {
            //alert('form was submitted');
            console.log(response);
            //location.reload();
            // if(window.location.host=="localhost"){
            //    // window.location.replace(window.location.origin+"/marketplace-new_copy/manage_templates.php");
            //     window.location.replace(window.location.origin+"/"+url+"/manage_templates.php");
            // }else {//if(window.location.host)
            //     window.location.replace(window.location.origin+"/Ether/manage_templates.php");
             
            // }
            window.location.replace(path_to_follow+"manage_templates.php");
          }
        });
}

// Bytes conversion
function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

function applyFilterManagepage(dataString){
    console.log(dataString);
    $.ajax({
        type: 'post',
        url: 'product.php',
        data: dataString,
        success: function (response) {
            //alert('form was submitted');
            console.log(response);
            $('.table-manage').html();
            $('.table-manage').html(response);
        }
    });
}

function applyFilterHomepage(dataString){
    console.log(dataString);
    $.ajax({
        type: 'post',
        url: 'product_home.php',
        data: dataString,
        dataType: 'json',
        success: function (response) {
            //alert('form was submitted');
            //console.log(response);
            //return false;
            $('.template-list-hold').html();
            $('.template-list-hold').html(response.home_html);

            if(response.selected_categories!=''){
                $(".cats_container").html(response.selected_categories);
                $('input.fil_cat_home[type=checkbox]').each(function () {
                    if(cat_filter_h.includes($(this).val())!=1){
                        cat_filter_h.push($(this).val());
                    }
                });
                console.log(cat_filter_h.join(","));
            }else if (response.selected_categories==''){
                var load_cat_dataString = 'searchcatstr=&filter_type=cat';
                console.log(load_cat_dataString);
                loadfilter(load_cat_dataString,"cat");
                cat_filter_h=[];
            }

            if(response.selected_tools!=''){
                $(".tools_container").html(response.selected_tools);
            }
            // check all checked tools
            //var dataString = "tools="+tools_filter_h.join(",")+"&cats="+cat_filter_h.join(",");
            console.log(tools_filter_h.join(","));
            // $('input.fil_tool_home[type=checkbox]').each(function () {
            //     sThisVal = (this.checked ? $(this).val() : ""); 
            //     console.log($(this).val());
            // });
            console.log(tools_filter_h.join(","));
            console.log(cat_filter_h.join(","));
            
        }
    });
}


function applyFilterCatHomepage(dataString){
    $.ajax({
        type: 'post',
        url: 'product_home_category.php',
        data: dataString,
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            //return false;loadfil
            $('.template-list-hold').html();
            $('.template-list-hold').html(response.home_html);
            if(response.selected_categories!=''){
                $(".cats_container").html(response.selected_categories);
            }else if (response.selected_categories==''){
                // var load_cat_dataString = 'searchcatstr=&filter_type=cat';
                // console.log(load_cat_dataString);
                // loadfilter(load_cat_dataString,"cat");
            }

            if(response.selected_tools!=''){
                $(".tools_container").html(response.selected_tools);
            }else if (response.selected_tools==''){
                var dataString = 'searchtoolstr=&filter_type=tool';
                console.log(dataString);
                loadfilter(dataString,"tool");
            }
            // check all checked tools
            //var dataString = "tools="+tools_filter_h.join(",")+"&cats="+cat_filter_h.join(",");
            console.log(tools_filter_h.join(","));
            // $('input.fil_tool_home[type=checkbox]').each(function () {
            //     sThisVal = (this.checked ? $(this).val() : ""); 
            //     console.log($(this).val());
            // });
            console.log(tools_filter_h.join(","));
            console.log(cat_filter_h.join(","));
            // $('input.fil_cat_home[type=checkbox]').each(function () {
            //     if(cat_filter_h.includes($(this).val())!=1){
            //         cat_filter_h.push($(this).val());
            //     }
            // });
            console.log(cat_filter_h.join(","));
        }
    });
}

function ajaxCall(){
   
    var str = $("form[name='login']").serialize();
    alert(str);

    $.ajax({
        type: 'post',
        url: 'check.php',
        data: str,
        success: function (response) {
            //alert('form was submitted');
            console.log(response);
        }
    }); 
}

function loadfilter(dataString,searchtype){
    $.ajax({
        type: 'post',
        url: 'search_filter.php',
        data: dataString,
        success: function (response) {
         // console.log(response);
          if(searchtype=="tool"){
            $(".tools_container").html(response);
            $('input.fil_tool_home[type=checkbox]').each(function () {
                console.log($(this).val());
                var index = tools_filter_h.indexOf($(this).val());
                if (index > -1) {
                    $(this).prop("checked",true);
                }
            });

          }else{
            $(".cats_container").html(response);
            $('input.fil_tool_home[type=checkbox]').each(function () {
                
                var index = cat_filter_h.indexOf($(this).val());
                if (index > -1) {
                    $(this).prop("checked",true);
                }
            });
          }
          
        }
      });
}
