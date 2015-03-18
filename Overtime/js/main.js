
//定义变量
var _user_data;
var _user_singleid;
var _user_genid;
var _user_name;
var _user_pswd;
var _user_id;
var _user_date;
var _user_pcip;
var _user_time_start;
var _user_daytype=1;
var _user_time_end;
var _user_time_minites;
var _user_time_hours;
var _user_work_reson;
var _user_mouth_currenthours;
var _user_mouth_lasthours;
var _user_id_text;
var _ot_type=1;    
var _is_exist=false; /*判断用户是否已经登记信息*/
var is_edit=false;

$(function(){ 
    //加载页面
    $( "#menutabs,#ottabs" ).tabs();
    $( ".ottabs-bottom .ui-tabs-nav, .ottabs-bottom .ui-tabs-nav > *" )
    .removeClass( "ui-corner-all ui-corner-top" )
    .addClass( "ui-corner-bottom" );

    // move the nav to the bottom
    $( ".ottabs-bottom .ui-tabs-nav" ).appendTo( ".ottabs-bottom" );

    $(".button").button();//.corner("10px");
    //$("#dialog-create,#dialog-login").css({"display":"none"});
    //显示时间
    showTime();
    //清空表格
    $("input[type=text],textarea").val("");
    //$("select").selectedIndex=0;
    $("input[value=first],input[value=datetype]").attr("checked", "checked");
    
    //设置button位置
    $("#submit").css({
        "margin-left":$("table").width()/8+"px"//-$("button").width()
    });
    $("#check").css({
        "width":"\""+$("button").width()+"\""+"px",
        "margin-left":$("table").width()/4+"px"
    });
    
    //设置选择时间项目
    (function( $ ) {
        $.widget( "ui.combobox", {
            _create: function() {
                var input,
                that = this,
                select = this.element.hide(),
                selected = select.children( ":selected" ),
                value = selected.val() ? selected.text() : "",
                wrapper = this.wrapper = $( "<span>" )
                .addClass( "ui-combobox" )
                .insertAfter( select );
                
                function removeIfInvalid(element) {
                    var value = $( element ).val(),
                    matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                    valid = false;
                    select.children( "option" ).each(function() {
                        if ( $( this ).text().match( matcher ) ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });
                    
                    if ( !valid ) {
                        //if ( 0 ) {
                        // remove invalid value, as it didn't match anything
                        $( element )
                        .val( "" )
                        .attr( "title", value + " didn't match any item" )
                        .tooltip( "open" );
                        select.val( "" );
                        setTimeout(function() {
                            input.tooltip( "close" ).attr( "title", "" );
                        }, 2500 );
                        input.data( "autocomplete" ).term = "";
                        return false;
                    }
                
                }
                
                input = $( "<input>" )
                .appendTo( wrapper )
                .val( value )
                .attr( "title", "" )
                .addClass( "ui-state-default ui-combobox-input" )
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                        response( select.children( "option" ).map(function() {
                            var text = $( this ).text();
                            if ( this.value && ( !request.term || matcher.test(text) ) )
                                return {
                                    label: text.replace(
                                        new RegExp(
                                            "(?![^&;]+;)(?!<[^<>]*)(" +
                                            $.ui.autocomplete.escapeRegex(request.term) +
                                            ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                            ), "<strong>$1</strong>" ),
                                    value: text,
                                    option: this
                                };
                        }) );
                    },
                    select: function( event, ui ) {
                        ui.item.option.selected = true;
                        that._trigger( "selected", event, {
                            item: ui.item.option
                        });
                    },
                    change: function( event, ui ) {
                        if ( !ui.item )
                            return removeIfInvalid( this );
                    }
                })
                .addClass( "ui-widget ui-widget-content ui-corner-left" );
                
                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
                };
                
                $( "<a>" )
                .attr( "tabIndex", -1 )
                .attr( "title", "Show All Items" )
                .tooltip()
                .appendTo( wrapper )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })
                .removeClass( "ui-corner-all" )
                .addClass( "ui-corner-right ui-combobox-toggle" )
                .click(function() {
                    // close if already visible
                    if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                        input.autocomplete( "close" );
                        removeIfInvalid( input );
                        return;
                    }
                    // work around a bug (likely same cause as #5265)
                    $( this ).blur();
                    // pass empty string as value to search for, displaying all results
                    input.autocomplete( "search", "" );
                    input.focus();
                });
                
                input
                .tooltip({
                    position: {
                        of: this.button
                    },
                    tooltipClass: "ui-state-highlight"
                });
            },
            
            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
        });
    })( jQuery );
    //$( "#user_week" ).combobox();
    
    
    //处理登录注册
    var create_name = $( "#name" ),
    create_genid = $( "#genid" ),
    create_single = $( "#single" ),
    //create_email = $( "#email" ),
    create_password = $( "#password" ),
    loginFields = $( [] ).add( create_name ).add( create_genid ).add( create_single ).add( create_password ),//定义对象包，返回Jquery类型
    tips = $( ".validateTips" );
    
    //init data
    //get _user_id_text html value;
    _user_id_text =$(".validateTips2").html();
    
    $( "#dialog-login" ).dialog({
        hide:false,   
        resizable:false,
        autoOpen: true,//false,
        height: 'auto',//firefox:400,
        width: 350,//firefox:300,
        modal: true,//true,
        position : ['top','right'] ,
        buttons: {
            "Login": function() {
                $.post("method/mysql_login.php", {
                    genid:$("#genidlg").val(),
                    password:$("#passwordlg").val()
                }, function (logindata){
                    if(logindata != false){//login success
                        //login success and init static value
                        _user_data=logindata.split("~");
                        //alert(_user_data[0]+_user_data[1]);
                        _user_genid=_user_data[0],
                        _user_name = _user_data[1];
                        _user_singleid = _user_data[2];
                        _user_pcip = _user_data[3];
                        _user_pswd = $("#passwordlg").val();
                        //自动填写表格
                        form_init();
                        $("#alogin").html("<span><font color = red;>"+$( "#user_name" ).val()+"   </font></span><span id=\"alayout\" style=\"color:red\" href=\"##\">[登出]</span>");
                        
                        $( "#dialog-login" ).dialog( "close" );
                       
                    }else{
                        $("#passwordlg,#namelg").addClass( "ui-state-error" );
                        $(".validateTips2").text( "Username and password must be correct." )
                        .addClass( "ui-state-highlight",0 );
                        setTimeout(function() {
                            $(".validateTips2").removeClass( "ui-state-highlight", 1500 );
                            $("#passwordlg,#namelg").removeClass( "ui-state-error");
                        }, 500 );
                        setTimeout(function() {
                            $(".validateTips2").html(_user_id_text);
                        },3000);
                        $("#passwordlg").val("");
                    } 
                })
            },
            "Create": function() {
                $( this ).dialog( "close" );
                $( "#dialog-create" ).dialog( "open" );
            }
        },
        close: function() {
            loginFields.val( "" ).removeClass( "ui-state-error" );
        //$("body").html("");
        }
    });
    
    $( "#dialog-create" ).dialog({
        hide:false,   
        resizable:false,
        autoOpen: false,//false,
        height: 'auto',//firefox:400,
        width: 350,//firefox:300,
        modal: true,//是否遮掩
        position : ['top','right'] ,
        //accessKey:"endter",
        buttons: {
            "Create": function() {
                var bValid = true;
                loginFields.removeClass( "ui-state-error" );
                
                bValid = bValid && checkLength( create_genid, "genid", 3, 16 );
                bValid = bValid && checkLength( create_name, "name", 3, 16 );
                bValid = bValid && checkLength( create_single, "single", 3, 16 );
                ///^[a-z]([0-9a-z_])+$/i
                //bValid = bValid && checkRegexp( create_single, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                //bValid = bValid && checkRegexp( create_email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
                bValid = bValid && checkRegexp( create_password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
                
                if ( bValid ) {
                    ///格式符合后执行下面
                    $.post("method/mysql_register.php", 
                    {
                        genid:$("#genid").val(),
                        name:$("#name").val(),
                        single:$("#single").val(),
                        password:$("#password").val(),
                        pcip:$("#pcip").text()
                    },function (logindata){
                        if(!logindata){
                            _user_genid=$("#genid").val();
                            $( "#dialog-create" ).dialog( "close" );
                            $( "#dialog-login" ).dialog( "open" );
                            $( "#dialog-login #genidlg" ).val(_user_genid);       
                        }else{
                            alert(logindata);
                        }
                    }); 
                }
            },
            "Login": function() {
                $( this ).dialog( "close" );
                $( "#dialog-login" ).dialog( "open" );
            }
        },
        close: function() {
            loginFields.val( "" ).removeClass( "ui-state-error" );
        }
    });
    $("#slogin").click(function(){
        $( "#dialog-login" ).dialog( "open" );
    });

    //设置日期
    $("#user_date").datepicker({
        //showButtonPanel: true,
        dateFormat: "yymmdd"
    });
    $("#submenue_date").datepicker({
        //        showOn: "button",
        //        buttonImage: "src/calendar.gif",
        //        buttonImageOnly: true,
        dateFormat: "yymmdd",
        showAnim:"drop"
    });
    
    /*$("#user_date").change(function (){
        $("#user_start,#user_end").val($("#user_date").val());
    });*/
    //自动计算
    $("#user_start,#user_end").change(function(){
        _user_time_start =$("#user_start").val();
        _user_time_end =$("#user_end").val();
        $("#user_mimutes").val(get_minites($("#user_start").val(),$("#user_end").val()));
        $("#user_time_c,#user_time_l").val(parseInt($("#user_mimutes").val()/60));
    });
    $("#user_resajax option[text='jQuery']").attr("selected", true);  
    $("#user_resajax").change(function(){
        $("#user_reason").val($("#user_resajax").val());
    });

    getevent();
    $("#addresajax").click(function(){
        if($("#user_reason").val()){
            $("#user_resajax").prepend("<option value='"+$("#user_reason").val()+"'>"+$("#user_reason").val()+"</option>");
            //$("#user_resajax option[value='0']").remove();
            $("#user_reason").val("");
        //alert($("#user_resajax").val());
        }
    });
}); 
function usersub(){

}
//updateTips o[selector] t[string]
function updateTips( t,o ) {
    o
    .text( t )
    .addClass( "ui-state-highlight" );
    setTimeout(function() {
        o.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
}

// o[selector] n[stirng(selector value)] min[num(min length)] max[num(max length)]
function checkLength( o, n, min, max ) {
    if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
            min + " and " + max + "." ,$( ".validateTips" ));
        return false;
    } else {
        return true;
    }
}
//$( "#dialog-create","#dialog-login" ).dialog().hide();
function checkRegexp( o, regexp, n ) {
    if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n ,$( ".validateTips" ));
        return false;
    } else {
        return true;
    }
}



function showTime(){
    var date =  new Date();
    var t= Date.parse(date);//parse是静态方法  不用创建date对象
    $("#watch").html("当前时间是："+new Date(t).toLocaleString());
    window.setTimeout(showTime,1000);
}

function get_minite(t){
    var m=0;
    if(t!=0){
        var start1 = parseInt(t.split(":")[0])//18
        var start2 = parseInt(t.split(":")[1]);//30
        m = start1*60+start2;//18*60+30
        return m>0?m:0;
    }
    //alert(m);
    return m;
}
function get_minites(b,e){
    b = Number(b);
    e = Number(e);
    if(b>=e)
        return 0;
    var b1=b%100>=0?b%100:-1;
    var b2=parseInt(b/100>0?b/100:-1);
    var e1=e%100>=0?e%100:-1;
    var e2=parseInt(e/100>0?e/100:-1);
    if(b1>=0&&b2>=0&&e1>=0&&e2>=0)
        return (e2*60+e1-b2*60-b1);
    return 0;
}


function getevent(){
    $("#submit").click(
        function (){
            if(isempty())
            {
                alert("表格不能为空！");
            }else {
                //判断是否已经提交代码
                $.post("method/mysql_isexist.php",{
                    genid:_user_genid,
                    password:_user_pswd,
                    work_date:$("#submenue_date").val(),
                    ot_type:_ot_type
                },function(isexist){
                    //alert(isexist);
                    $.post("method/mysql_insert.php", 
                    {
                        name:$("#user_name").val(),
                        genid:$("#user_genid").val(),
                        password:_user_pswd,
                        date:$("#user_date").val(),
                        type:$("#user_week").val(),
                        from:_user_time_start,
                        end: _user_time_end,
                        mimutes:$("#user_mimutes").val(),
                        reason:$("#user_reason").val(),
                        time_c:$("#user_time_c").val(),
                        time_l:$("#user_time_l").val(),
                        ot_type:"1"//getradio($("#radio_Ot input[type=checked]"))
                    },function (insertdata){
                        //$("input[type=text],textarea").val("");
                        form_init();
                        if(!insertdata){
                            //_is_exist = flase;
                            alert(insertdata+"插入成功");
                        }else{
                            alert("插入失败,Cause:"+insertdata);

                        }
                    });                            
                });
                              
            }
        }
        );
    
    
    $("#sub_check").click(function(){
        if(!$("#submenue_date").val()){
            alert("请选择提交的时间");
        }else{
            
            $( "#sub_effect" ).effect( "drop", {}, 500, function(){
                setTimeout(function() {
                    
                    $.getJSON("method/mysql_get_datetable.php", 
                    {
                        date:$("#submenue_date").val(),
                        genid:$("#user_genid").val(),
                        password:_user_pswd,
                        ot_type:_ot_type
                    },function (sub_checkdata){
                        //分割
                        $("#sub_loadtable_data").html(function(){
                            var html='';
                            for(var value in sub_checkdata){//sub_checkdata.width
                                //value >= 8，只显示前8行，翻页在显示其余值
                                html+="<tr><td>"+value+"</td>";
                                for(var value2 in sub_checkdata[value]){
                                    html+= ("<td>"+sub_checkdata[value][value2]+"</td>");
                                }
                                html+=("</tr>");
                            } 
                            return html;
                        });

                        $( "#sub_effect" ).removeAttr( "style" ).hide().fadeIn();
                    },function(){
                        $("#sub_loadtable_data").html("fail");
                    });
                }, 0 );
            } );   
            $.post("method/mysql_download.php", 
            {
                date:$("#submenue_date").val(),
                genid:$("#user_genid").val(),
                password:_user_pswd,
                ot_type:_ot_type
            },function (mysql_downloaddata){
                if(mysql_downloaddata){
                    //alert(mysql_downloaddata);
                    $("#file_url").css("display","block");
                }else{
                //alert("-"+mysql_downloaddata);
                }
            }); 
            
        }
        $("#sub_delete").click(function(){
            alert("只能删除当天提交的信息");
            $.post("method/mysql_delete.php", 
            {
                genid:$("#user_genid").val(),
                password:_user_pswd,
                date:get_currentdate(),
                ot_type:"1"
            },function (sub_checkdata){
                $("#sub_loadtable").html(sub_checkdata);
                $( "#sub_effect" ).removeAttr( "style" ).hide().fadeIn();
            });
        });
       
    //return false; 
    });
    $( document ).tooltip();
}

function isempty(){
    if($("#user_name").val()==""||
        $("#user_id").val()==""||
        $("#user_date").val()==""||
        $("#user_week").val()==""||
        $("#user_start").val()==""||
        $("#user_end").val()==""||
        $("#user_hours").val()==""||
        $("#user_reason").val()==""||
        $("#user_time_c").val()==""||
        $("#user_time_l").val()=="")
        return true;
    else 
        return false;
}


function form_init(){
    $("#user_name").attr("value",_user_name);
    $("#user_genid").attr("value",_user_genid);
    $("#user_date").attr("value",get_currentdate());
    $("#submenue_date").attr("value",get_currentdate());
    $("#user_start").val("0");
    $("#user_end").val("0");
    $("#user_hours").val("");
    $("#user_reason").val("");
    $("#user_time_c").val("");
    $("#user_time_l").val("");
}
function data_is_exist(){
    $("#check").attr("value","cancle");
    $("#submit").attr("value","edit");
}

function data_isnot_exist(){
    $("#submit").attr("value","submit");
    $("#check").attr("value","check");
}



function get_currentdate(e){
    if(e!=undefined)
        return e;
    var de = new Date();
    var y = de.getFullYear().toString();
    var m = (de.getMonth()+1)>9?(de.getMonth()+1).toString():("0"+(de.getMonth()+1).toString());
    var d = (de.getDate())+1>9?(de.getDate()).toString():("0"+(de.getDate()).toString());
    return y+m+d;//+de.getHours().toString();//20130107
}
function getradio(o){
    for(var i=0;i<o.length;i++){
        if(o[i].checked){
            return o[i].attributes["value"].value;
        }
    }
}

function get_fullname(e){
    if(e==undefined)
        e=get_currentdate();
}