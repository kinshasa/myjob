<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>滚动效果</title>
        <link rel="stylesheet" href="jquery/css/ui-darkness/jquery-ui-1.9.2.custom.css" />
        <script src="jquery/js/jquery-1.8.3.js"></script>
        <script src="jquery/js/jquery-ui-1.9.2.custom.js"></script>   
        <link  rel="stylesheet" href="./css/index.css"/>
        <style type="text/css">
            #scroll{margin:100px;width:480px;height:110px;background:#F3F3F3;border:#E3E3E3 1px solid;padding:5px;}
            #prev{width:15px;height:72px;float:left;text-indent:-5000px;background:url(images/prev.jpg) no-repeat;cursor:pointer;margin-top:10px;}
            #next{width:15px;height:72px;float:right;text-indent:-5000px;background:url(images/next.jpg) no-repeat;cursor:pointer;margin-top:10px;}
            #box{width:440px;float:left;display:block;overflow:hidden;margin-left:5px;}
            #box ul li{width:110px;float:left;text-align:center;}
            #box ul li a{display:block;color:#666;padding:5px 0;}
            #box ul li a:hover{background:#d1d1d1;color:#000;}
            #box ul li a img{width:100px;height:80px;margin-bottom:5px;}

            #boximg{width:440px;float:left;display:block;overflow:hidden;margin-left:5px;}
            #boximg ul li{width:110px;float:left;text-align:center;}
            #boximg ul li a{display:block;color:#666;padding:5px 0;}
            #boximg ul li a img{width:400px;height:300px;margin-bottom:5px;}
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                (function($) {
                    $.fn.jCarouselLite = function(o) {
                        o = $.extend({
                            btnPrev: null, btnNext: null, btnGo: null, mouseWheel: false, auto: null, speed: 200, easing: null, vertical: false, circular: true, visible: 3, start: 0, scroll: 1, beforeStart: null, play: true,
                            afterEnd: null
                        }, o || {});
                        return this.each(function() {
                            var b = false, animCss = o.vertical ? "top" : "left", sizeCss = o.vertical ? "height" : "width";
                            var c = $(this), ul = $("ul", c), tLi = $("li", ul), tl = tLi.size(), v = o.visible;
                            ul.bind("mouseover", function() {
                                if (o.play) {
                                    o.play = false;
                                }
                            })
                            ul.bind("mouseout", function() {
                                if (!o.play) {
                                    o.play = true;
                                }
                            })
                            if (o.circular) {
                                ul.prepend(tLi.slice(tl - v - 1 + 1).clone()).append(tLi.slice(0, v).clone());
                                o.start += v
                            }
                            var f = $("li", ul), itemLength = f.size(), curr = o.start; c.css("visibility", "visible");
                            f.css({ overflow: "hidden", "float": o.vertical ? "none" : "left" });
                            ul.css({ margin: "0", padding: "0", position: "relative", "list-style-type": "none", "z-index": "1" });
                            c.css({ overflow: "hidden", position: "relative", "z-index": "2", left: "0px" });
                            var g = o.vertical ? height(f) : width(f);
                            var h = g * itemLength;
                            var j = g * v; f.css({ width: f.width(), height: f.height() });
                            ul.css(sizeCss, h + "px").css(animCss, -(curr * g));
                            c.css(sizeCss, j + "px");
                            if (o.btnPrev) $(o.btnPrev).click(function() {
                                return go(curr - o.scroll)
                            });
                            if (o.btnNext) $(o.btnNext).click(function() {
                                return go(curr + o.scroll)
                            });
                            if (o.btnGo) $.each(o.btnGo, function(i, a) {
                                $(a).click(function() { return go(o.circular ? o.visible + i : i) })
                            });
                            if (o.mouseWheel && c.mousewheel) c.mousewheel(function(e, d) {
                                return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll)
                            });
                            if (o.auto) {
                                setInterval(AutoPlay, o.auto + o.speed);
                            }
                            function vis() {
                                return f.slice(curr).slice(0, v)
                            };
                            function AutoPlay() { if (o.play) { go(curr + o.scroll); } };
                            function go(a) {
                                if (!b) {
                                    if (o.beforeStart) o.beforeStart.call(this, vis());
                                    if (o.circular) {
                                        if (a <= o.start - v - 1) {
                                            ul.css(animCss, -((itemLength - (v * 2)) * g) + "px");
                                            curr = a == o.start - v - 1 ? itemLength - (v * 2) - 1 : itemLength - (v * 2) - o.scroll
                                        }
                                        else if (a >= itemLength - v + 1) {
                                            ul.css(animCss, -((v) * g) + "px");
                                            curr = a == itemLength - v + 1 ? v + 1 : v + o.scroll
                                        }
                                        else
                                            curr = a
                                    }
                                    else {
                                        if (a < 0 || a > itemLength - v)
                                            return;
                                        else curr = a
                                    }
                                    b = true;
                                    ul.animate(animCss == "left" ? { left: -(curr * g)} : { top: -(curr * g) }, o.speed, o.easing, function() {
                                        if (o.afterEnd) o.afterEnd.call(this, vis()); b = false
                                    });
                                    if (!o.circular) {
                                        $(o.btnPrev + "," + o.btnNext).removeClass("disabled");
                                        $((curr - o.scroll < 0 && o.btnPrev) || (curr + o.scroll > itemLength - v && o.btnNext) || []).addClass("disabled")
                                    }
                                } return false
                            }
                        })
                    };
                    function css(a, b) { return parseInt($.css(a[0], b)) || 0 };
                    function width(a) { return a[0].offsetWidth + css(a, 'marginLeft') + css(a, 'marginRight') };
                    function height(a) { return a[0].offsetHeight + css(a, 'marginTop') + css(a, 'marginBottom') }

                })(jQuery); 
                //上/下 一页
                $("#box").jCarouselLite({  //jCarouselLite 插件
                    btnPrev: "#prev",
                    btnNext: "#next",
                    auto: 4000, //图片停留时间
                    scroll: 4, //每次滚动覆盖的图片个数
                    speed: 1000, //设置速度，0是不动。其次就是数字越大 ，移动越慢。
                    vertical: false,//横向（true），竖向（false）
                    visible: 4, //显示的数量
                    circular: true //是否循环
                });
    
                // 当前图片
                $("#boximg ul li:not(:first)").hide();  //除了第一张，其它的照片隐藏
                $("#box ul li").each(function(i){ //每个imgbox中的图片
                    $(this).click(function(){  
                        $("#boximg ul li").hide(); //点击 box ul li，boximg ul li隐藏，$("#boximg ul li")[i%($("#box ul li").length/3)] 好算法
                        $($("#boximg ul li")[i%($("#box ul li").length/3)]).fadeIn("slow");  
                    })
                })
            });

        </script>
    </head>
    <body>
        <div id="scroll">
            <span id="prev">上一张</span>
            <div id="box">
                <ul>
                    <li><a href="#"><img src="images/01.bmp"/>现在再开网店晚了</a></li>
                    <li><a href="#"><img src="images/02.bmp"/>现在再开网店晚了</a></li>
                    <li><a href="#"><img src="images/03.bmp"/>现在再开网店晚了</a></li>
                    <li><a href="#"><img src="images/04.bmp"/>现在再开网店晚了</a></li> 
                </ul>
            </div> 
            <span id="next">下一张</span>
        </div> 
        <div id="boximg">
            <ul>
                <li><a href="#"><img src="images/01.bmp"/>现在再开网店晚了</a></li>
                <li><a href="#"><img src="images/02.bmp"/>现在再开网店晚了</a></li>
                <li><a href="#"><img src="images/03.bmp"/>现在再开网店晚了</a></li>
                <li><a href="#"><img src="images/04.bmp"/>现在再开网店晚了</a></li>
            </ul>
        </div> 

    </body>
</html>
