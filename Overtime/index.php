<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="generator" content="Docutils 0.8.1: http://docutils.sourceforge.net/" />
        <title>加班申请网</title>
        <meta name="author" content="Jeff McKenna, Gateway Geomatics" />
        <link rel="stylesheet" href="jquery/css/ui-darkness/jquery-ui-1.9.2.custom.css" />
        <script src="jquery/js/jquery-1.8.3.js"></script>
        <script src="jquery/js/jquery-ui-1.9.2.custom.js"></script>   
        <link  rel="stylesheet" href="./css/index.css"/>
        <script type="text/javascript" src="./js/main.js"></script> 
    </head>
    <body>
        <?php include 'method/head.php'; ?>
        <h2>S/W 2 Group 4 Part加班申请 </h2>
        <p>
            <a style="float: right"><font id="watch" color = red;>当前时间是：</font></a>
            <a id="alogin"><a id="slogin" href="##" style="color:red">立即登录</a></a>
        </p>

        <div  id="menutabs" style="font-size: 12px;width:1330px;height: 550px;">
            <ul>
                <li><a href="#menutabs-1">Overtime</a></li>
                <li><a href="#menutabs-2">人性化设置</a></li>
                <li><a href="#menutabs-3">待开发</a></li>
                <li><a href="#menutabs-4">待开发</a></li>
                <li><a href="#menutabs-5">自定义统计</a></li>
                <li><a href="#menutabs-6">后门程序</a></li>
            </ul>
            <div id="menutabs-1"class="menutabs" >
                <div id="ottabs" style="width: 387px" class="ottabs-bottom" >
                    <ul>
                        <li><a href="#ottabs-1">一次表格</a></li>
                        <li><a href="#ottabs-2">二次表格</a></li>
                    </ul>
                    <div id="ottabs-1" class="ottabs">
                        <div id="intputdata" style="" class="menutabs">
                            <table border="1">
                                <tr>
                                    <td><a>姓名</a></td>
                                    <td><input readonly="1" class="inputfull" type="text"id="user_name"/></td>
                                </tr>
                                <tr>
                                    <td><a>个人ID</a></td>
                                    <td><input readonly="1"class="inputfull" type="text" id="user_genid"/></td>
                                </tr>
                                <tr>
                                    <td><a>日期</a></td>
                                    <td><input  type="text" class="inputfull" id="user_date"/></td>
                                </tr>
                                <tr>
                                    <td><a>勤态星期代码</a></td>
                                    <td>
                                        <select class="inputfull" id="user_week">
                                            <option value="1">1：平日 </option>
                                            <option value="3">3：周休</option>
                                            <option value="4">4：法定</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a>计划时间段</a></td>
                                    <td id="t1234">

                                        <select id="user_start">
                                            <option value="0">Start：</option>
                                            <option value="0830">08：30</option>
                                            <option value="1000">10：00</option>
                                            <option value="1300">13：00</option>
                                            <option value="1830">18：30</option>

                                        </select>
                                        <select id="user_end">
                                            <option value="0">End：</option>
                                            <option value="1730">17：30</option>
                                            <option value="2030">20：30</option>
                                            <option value="2200">22：00</option>
                                            <option value="2330">23：30</option>
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td><a>计划加班时间</a></td>
                                    <td><input  type="text" readonly="1" class="inputfull" id="user_mimutes"/></td>
                                </tr>
                                <tr>
                                    <td><a>加班事由其他</a></td>
                                    <td>
                                        <textarea cols="25" rows="2" type="text" class="inputfull" style="resize:none" id="user_reason"></textarea>
                                        <input type ="button" id="addresajax" float="left"  title="add text string" value="" style="background-image: url('src/calendar.gif')" />
                                        <select id="user_resajax" length="3" >
                                            <option  value="0">您未添加文本本据</option>
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td><a>本月已申请加班时间（h）</a></td>
                                    <td><input  type="text" class="inputfull" id="user_time_c"/></td>
                                </tr>
                                <tr>
                                    <td><a>上月实际加班时间（h）</a></td>
                                    <td><input  type="text" class="inputfull" id="user_time_l"/></td>
                                </tr>
                                <tr>
                                    <td>
                                        加班表格类型
                                    </td>
                                    <td>
                                        <form id="radio_otsub">
                                            <input type="radio" checked="checked"  name="Ot" value="1" />
                                            <span>一次</span>
                                            <input type="radio" name="Ot" value="2" />
                                            <span>二次</span>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            <input type="button" id="submit" class="button" value="submit"/>
                            <input type="button" id="check" disabled="disabled" class="button" value="check"/>
                        </div>
                    </div>
                    <div id="ottabs-2" class="ottabs"></div>

                </div>



                <div style=""class="ui-corner-all ui-corner-top ui-corner-right ui-corner-tr"id="submitdiv">

                    <div class =" submenue">
                        <form>
                            <p>
                                <input title="check" type="button" class="button"  style="font-size: 12px;"  value="切克闹" id="sub_check" />
                                <input type="radio" checked="checked"  style="font-size: 11px" name="checktype" value="datetype" />
                                <span>提交时间</span>
                                <input type="text" size="15" title="查询日期" id="submenue_date"/>
                                <input type="radio" name="checktype" value="historytype" />
                                <span>提交记录</span>

                            </p>
                        </form>
                    </div>

                    <div id="sub_datetable" style="margin-top: 14px;">

                        <!--<h3 class="ui-widget-header ui-corner-all">查询结果</h3>-->
                        <div id=""></div>
                        <div id="sub_effect">
                            <div id="sub_loadtable"  style="border: 1px solid #666666;margin: 3px;height: 378px">
                                <table id="sub_loadtable_data" style="height: 38px;" border="1" >
                                    
                                </table>
                                <form id="radio_otdel">
                                    <div id="pageupdown" style="position:absolute;bottom: 103px;width: 877px;height: 21px;font-size: 11px">
                                        <div style="float: right">
                                            <input type="button" id="pageup"  value="Next"/>
                                            <span id="curpage" >1</span>/<span id="equpage">1</span>
                                            <input type="button" value="Last"/>
                                        </div>
                                        <input type="radio" checked="checked"  name="Ot" value="1" />
                                        <span>一次</span>
                                        <input type="radio" name="Ot" value="2" />
                                        <span>二次</span>
                                        <input type="button" id="delete_curdata" title="del cur data" value="delete"/>
                                        <p id="file_url" style=" margin-left: 20px; margin-top: 20px;display: block">
                                            <?php echo "自动创建" . FILE_FULLNAME_FIRST; ?>
                                            <a target="_blank" href="./SW Group2 Part4每天加班统计//<?php echo FILE_NAME_FIRST ?>"style="color:red">[立即打开]</a>
                                            <input type="button" value="delete" id="sub_delete"/>
                                        </p>
                                    </div>
                                </form>
                            </div>

                        </div>


                    </div>
                </div>  
            </div>
            <div id="menutabs-2" class="menutabs">
                <p><a id="add_res" href="http://localhost/overtime/ot_add_res.php"target="_blank">加班原因管理</a></p>
                <p>姓名密码管理</p>
                <p>加班信息管理</p>
                <p>背景主题管理</p>
                <p>字体格式设置</p>
                <p>申请加班担当</p>
                <p>其他</p>
            </div>
            <div id="menutabs-3" class="menutabs">

            </div>
            <div id="menutabs-4" class="menutabs">
            </div>
            <div id="menutabs-5" class="menutabs">
                <span>待开发</span>
            </div>
            <div id="menutabs-6" class="menutabs">
                <span>您没有最高权限，请联系管理员</span>
            </div>
        </div>
        <p id="bottominf" style="position:relative; top: 30px;">
            <a target="_blank" href="https://me.alipay.com/liushaobo" title="小小赞助大大帮助">
                <img src="./src/pay_encourage.png" width="159" height="37" alt="支付鼓励" align="absmiddle">
            </a>

            <?php
            echo '<a>您的IP地址：<font id="pcip" color = red>' . GetIP() . '</font>.  </a>';
            echo '<a>made by shaob.liu@samsung.com</a>';
            ?>
        </p>

        <div id="dialog-create" title="Create" class="dialog" style="display: none">
            <fieldset>
                <label for="genid">Genid(12570990)</label>
                <input type="text" title="your gen number" name="genid" id="genid" class="text ui-widget-content ui-corner-all" />
                <label for="name">Name(刘少波)</label>
                <input type="text" title="your name" name="name" id="name" class="text ui-widget-content ui-corner-all" />
                <label for="single">SingleID(shaob.liu)</label>
                <input type="text" title="your single" name="single" id="single" class="text ui-widget-content ui-corner-all" />
                <!--                    <label for="email">Email(shaob.liu@samsung.com)</label>
                                    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />-->
                <label for="password">Password(a1234)</label>
                <input type="password" title="your password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
                <!--                    <label for="password">Infor</label>
                                    <input type="password" name="infor" id="infor" value="" class="text ui-widget-content ui-corner-all" />-->
            </fieldset>
            <p class="validateTips" style="text-align: center"><?php echo '您的IP地址：<font color = red>' . GetIP() . '</font> .'; ?></p>
        </div>
        <div id="dialog-login" title="Login" class="dialog" style="display: none">
            <form>
                <fieldset>
                    <label for="name" >Genid(12570990)</label>
                    <input type="text"title="your gen number" name="genidlg" id="genidlg" class="text ui-widget-content ui-corner-all" />
                    <label for="password">Password</label>
                    <input type="password" title="your password" name="passwordlg" id="passwordlg"  class="text ui-widget-content ui-corner-all" />
                </fieldset>
            </form>

            <p  class="validateTips2"  style="text-align: center"><a style="margin-left: 20px;float: left" ><input type='checkbox' title='remanber paswd'/>记住</a> <a> <?php echo '您的IP地址：<font color = red>' . GetIP() . '</font> .'; ?></a></p>
        </div>
        <div style="display: none">
            一次表格（计划加班统计表）
            <br/>                <br/>

            1.IDNO 输入员工的GEN;
            <br/>
            2. WORKDT: 输入加班日期.例如20120516;
            <br/>
            3.WEEKCD:  输入 1平日, 3周休,4法定;
            <br/>
            4.FRTIME: 输入加班的开始时间,例如 201205021830;
            <br/>
            5.ENTIME: 输入加班的结束时间,例如 201205022130
            <br/>                <br/>
            <br/>
            二次表格（超过计划范围内的请第二天重新按照这个表格申请）
            <br/>                <br/>

            1.IDNO: 输入员工的GEN;
            <br/>
            2.WORKDT: 输入加班日期.例如20120516;
            <br/>
            3.FRTIME: 输入加班的开始时间,例如 201205021830;
            <br/>
            4.ENTIME: 输入加班的结束时间,例如 201205022130;
            <br/>
            5.OTTIME: 输入加班多少分钟;
            <br/>
            6.WORKTIME: 输入工作时间，一般为480分钟;
            <br/>
            7.OTCAUSEETC: 输入加班原因;
            <br/>
            8.WEEKCD：输入 1平日, 3周休,4法定;
            <br/>
            9.WORKTYPECD：输入工作形态代码 A;   
            <tr>
                                        <th>序号</th>
                                        <th>姓名</th>
                                        <th>个人ID</th>
                                        <th>日期</th>
                                        <th>勤态星期代码</th>
                                        <th>计划开始时间</th>
                                        <th>计划完了时间</th>
                                        <th>计划加班时间</th>
                                        <th>加班事由其他</th>
                                        <th>本月已申请加班时间（h）</th>
                                        <th>上月实际加班时间（h）</th>
                                    </tr>
                                    
                                    <tr>
                                        <td>1</td>
                                        <td>姓名</td>
                                        <td>个人ID</td>
                                        <td>日期</td>
                                        <td>勤态星期代码</td>
                                        <td>计划开始时间</td>
                                        <td>计划完了时间</td>
                                        <td>计划加班时间</td>
                                        <td>加班事由其他</td>
                                        <td>本月已申请加班时间（h）</td>
                                        <td>上月实际加班时间（h）</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>姓名</td>
                                        <td>个人ID</td>
                                        <td>日期</td>
                                        <td>勤态星期代码</td>
                                        <td>计划开始时间</td>
                                        <td>计划完了时间</td>
                                        <td>计划加班时间</td>
                                        <td>加班事由其他</td>
                                        <td>本月已申请加班时间（h）</td>
                                        <td>上月实际加班时间（h）</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>姓名</td>
                                        <td>个人ID</td>
                                        <td>日期</td>
                                        <td>勤态星期代码</td>
                                        <td>计划开始时间</td>
                                        <td>计划完了时间</td>
                                        <td>计划加班时间</td>
                                        <td>加班事由其他</td>
                                        <td>本月已申请加班时间（h）</td>
                                        <td>上月实际加班时间（h）</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>姓名</td>
                                        <td>个人ID</td>
                                        <td>日期</td>
                                        <td>勤态星期代码</td>
                                        <td>计划开始时间</td>
                                        <td>计划完了时间</td>
                                        <td>计划加班时间</td>
                                        <td>加班事由其他</td>
                                        <td>本月已申请加班时间（h）</td>
                                        <td>上月实际加班时间（h）</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>姓名</td>
                                        <td>个人ID</td>
                                        <td>日期</td>
                                        <td>勤态星期代码</td>
                                        <td>计划开始时间</td>
                                        <td>计划完了时间</td>
                                        <td>计划加班时间</td>
                                        <td>加班事由其他</td>
                                        <td>本月已申请加班时间（h）</td>
                                        <td>上月实际加班时间（h）</td>
                                    </tr>
        </div>
    </body>

</html>


