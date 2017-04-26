<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<style>
    span{
        font-size: 14px;
    }
    li{
        list-style: none;
        /*text-align: center;*/
    }
    .state{
        font-size: 12px;
        color: red;
    }
    .content{
        width: 700px;
        height: 200px;
        margin: auto;
        /*text-align: center;*/
    }
    .left{
        widows: 400px;
        height: 200px;
        float: left;
    }
    .right{
        width: 300px;
        height:200px;
        float: left;
    }
    .footer{
        width: 700px;
        height: 500px;
        float: right;
    }
</style>
<div class="content">
    <h1 align="center">密码生成功能</h1>
    <div>
        <form action="test.php" method="post">
            <div class="left">
                <div>
                    1. 密码长度(<span class="state">默认为6位</span>)：
                </div>
                <div>
                    2. 要生成的密码数量(<span class="state">默认为一个</span>)：
                </div>
                <div>
                    3. 密码字符类型(<span class="state">默认为全选</span>)：
                </div>
                <div>
                    4. 要过滤的字符：
                </div>
                <br>
                <div align="center"><input type="submit" value="生成"></div>
            </div>
            <div class="right">
                <input type="hidden" name="flag" value="flag">
                <div><input type="number" name="length" min="6" max="20" size="5" value="<?php if(empty($_POST['flag'])){echo '6';}else{echo $_POST['length'];}?>"></div>
                <div><input type="number" min="1" size="5" max="20" name="number" value="<?php if(empty($_POST['flag'])){echo '1';}else{echo $_POST['number'];}?>"  ></div>
                <div><input type="checkbox" <?php if(empty($_POST['flag'])){echo 'checked';}else{$type = $_POST['type'];if(in_array('1',$type)){echo 'checked';}}?> name="type[]" value="1">A-Z
                    <input type="checkbox" <?php if(empty($_POST['flag'])){echo 'checked';}else{$type = $_POST['type'];if(in_array('20',$type)){echo 'checked';}}?> name="type[]" value="20">a-z
                    <input type="checkbox" <?php if(empty($_POST['flag'])){echo 'checked';}else{$type = $_POST['type'];if(in_array('40',$type)){echo 'checked';}}?> name="type[]" value="40">9-0
                    <input type="checkbox" <?php if(empty($_POST['flag'])){}else{$type = $_POST['type'];if(in_array('80',$type)){echo 'checked';}}?> name="type[]" value="80">!@#$%&*/.</div>
                <div><input type="text" size="5" value="<?php if(empty($_POST['flag'])){echo '';}else{ if(empty($_POST['filter'])){echo '';}else{echo $_POST['filter'];}}?>" name="filter" ></div>
                <br>
                <div ><input type="reset" value="重置"></div>
            </div>
        </form>
        <div class="footer">
            <?php
            //                echo "4324";
            //            $type = $_POST['type'];
            //            $text = '43324';
            //            echo strlen($text);
            //                echo rand(1,20);
            //                exit();
            //                echo "12321";
            if(empty($_POST['flag'])){
                exit();
            }else{
                $number = $_POST['number'];
                $length = $_POST['length'];
                if(empty($_POST['filter'])){
                    $filter = '';
                }else{
                    $filter = $_POST['filter'];
                }
                $type = $_POST['type'];
                $A_letter = 'ABCDEFGHIJKLMNOPQISTUVWXYZ';
                $a_letter = 'abcdefghijklmnopqistuvwxyz';
                $S_figure = '0123456789';
                $S_string = '!@#$%&*/.';
                if($number<1) $number = 1;
                if($length<6) $length = 6;
                $size = sizeof($type);
                //计算字符比例
                $scale = $length / $size;
//                echo (int)$scale;
                $scale = (int)$scale;
                $text_arr = array();
                /**
                 *
                 * 根据比例生成固定的字符串，每个字符串都会先按照字符的比例随机填充，如果不够就重新运行一遍
                 * 并且对要过滤的字符串做了处理
                 **/
                for($l=1;$l<=$number;$l++){
                    $text = '';
                    $sum = 0;
                    while(1){
                        if($sum==$length){
                            break;
                        }
                        for($i=1;$i<=$size;$i++){
                            if($sum==$length){
                                break;
                            }
                            if($type[$i-1]==1){
                                for ($j=1;$j<=$scale;$j++){
                                    $rand_str = $A_letter[rand(0,25)];
                                    while(1){
                                        if(strpos($filter,$rand_str)===FALSE){
                                            break;
                                        }
                                        $rand_str = $A_letter[rand(0,25)];
                                    }
                                    $text = $text.$rand_str;
                                    $sum = $sum + 1;
                                    if($sum==$length){
                                        break;
                                    }
                                }
                            }else if($type[$i-1]==20){
                                for ($j=1;$j<=$scale;$j++){
                                    $rand_str = $a_letter[rand(0,25)];
                                    while(1){
                                        if(strpos($filter,$rand_str)===FALSE){
                                            break;
                                        }
                                        $rand_str = $a_letter[rand(0,25)];
                                    }
                                    $text = $text.$rand_str;
                                    $sum = $sum + 1;
                                    if($sum==$length){
                                        break;
                                    }
                                }
                            }else if($type[$i-1]==40){
                                for ($j=1;$j<=$scale;$j++){
                                    $rand_str = $S_figure[rand(0,9)];
                                    while(1){
                                        if(strpos($filter,$rand_str)===FALSE){
                                            break;
                                        }
                                        $rand_str = $S_figure[rand(0,9)];
                                    }
                                    $text = $text.$rand_str;
                                    $sum = $sum + 1;
                                    if($sum==$length){
                                        break;
                                    }
                                }
                            }else if($type[$i-1]==80){
                                for ($j=1;$j<=$scale;$j++){
                                    $rand_str = $S_string[rand(0,8)];
                                    while(1){
                                        if(strpos($filter,$rand_str)===FALSE){
                                            break;
                                        }
                                        $rand_str = $S_string[rand(0,8)];
                                    }
                                    $text = $text.$rand_str;
                                    $sum = $sum + 1;
                                    if($sum==$length){
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    $text_arr[$l-1] = $text;
                }
//                var_dump($text_arr);
                /**
                 * 使用得到的字符串来随机位置
                **/
//                $text = '';
//                $text[2] = '1';
//                if(!isset($text[2])) echo "34";
                echo '<h3 align="">生成结果</h3>';
                for ($i=1;$i<=$number;$i++){
//                    echo $text_arr[$i-1];
                    $text = '';
                    for ($j=1;$j<=$length;$j++){
                        while(1){
                            $rand_num = rand(0,50);
                            if(!isset($text[$rand_num])){
                                $text[$rand_num] = $text_arr[$i-1][$j-1];
                                break;
                            }
                        }
                    }
                    $password = '';
                    for($l=0;$l<=50;$l++){
                        if(isset($text[$l])){
                            $password = $password.$text[$l];
                        }
                    }
                    echo $i.'： <textarea rows="1" cols="20" style="font-size="11px";">'.$password.'</textarea>    密码强度：';
                    $pass_num = testPassword($password);
                    echo $pass_num.'/5   ';
                    if($pass_num==1){
                        echo '<span style="color: maroon">检测提示：密码过于简单(很容易就能破解你的密码)</span><br>';
                    }else if($pass_num==2){
                        echo '<span style="color: red">检测提示：密码强度差(建议在设置复杂点)</span><br>';
                    }else if($pass_num==3){
                        echo '<span style="color: #98bc1b">检测提示：密码强度中(呵呵，标准安全密码)</span><br>';
                    }else if($pass_num==4){
                        echo '<span style="color: green">检测提示：密码强度高(你的密码很安全)</span><br>';
                    }else if($pass_num==5){
                        echo '<span style="color: blue">检测提示：密码强度极高(暴力破解需要1万年以上)</span><br>';
                    }
                }

//                if($sum==1){
//                    $text = $A_letter;
//                }else if($sum==20){
//                    $text = $a_letter;
//                }else if($sum==40){
//                    $text = $S_figure;
//                }else if($sum==80){
//                    $text = $S_string;
//                }else if($sum==21){
//                    $text = $A_letter.$a_letter;
//                }else if($sum==41){
//                    $text = $A_letter.$S_figure;
//                }else if($sum==81){
//                    $text = $A_letter.$S_string;
//                }else if($sum==61){
//                    $text = $A_letter.$a_letter.$S_figure;
//                }else if($sum==101){
//                    $text = $A_letter.$a_letter.$S_string;
//                }else if($sum==121){
//                    $text = $A_letter.$S_figure.$S_string;
//                }else if($sum==60){
//                    $text = $a_letter.$S_figure;
//                }else if($sum==100){
//                    $text = $a_letter.$S_string;
//                }else if($sum==140){
//                    $text = $a_letter.$S_figure.$S_string;
//                }else if($sum==120){
//                    $text = $S_figure.$S_string;
//                }else{
//                    $text = $A_letter.$a_letter.$S_figure.$S_string;
//                }




//                $str_num = strlen($text) - 1;
//
//                for($i=1;$i<=$number;$i++){
//                    $password = '';
//                    for($j=1;$j<=$length;$j++){
//                        $rand_num = rand(1,$str_num);
//                        $password = $password.$text[$rand_num];
//                    }
//                    echo $i.'： '.$password.'    密码强度：';
//                    $pass_num = testPassword($password);
//                    echo $pass_num.'/5   ';
//                    if($pass_num==1){
//                        echo '<span style="color: maroon">检测提示：密码过于简单(只要花点时间，就能破解你的密码了)</span><br>';
//                    }else if($pass_num==2){
//                        echo '<span style="color: red">检测提示：密码强度差(建议在设置复杂点)</span><br>';
//                    }else if($pass_num==3){
//                        echo '<span style="color: #98bc1b">检测提示：密码强度良好(呵呵，标准安全密码了)</span><br>';
//                    }else if($pass_num==4){
//                        echo '<span style="color: green">检测提示：密码强度高(嘎嘎，你的密码很安全了)</span><br>';
//                    }else if($pass_num==5){
//                        echo '<span style="color: blue">检测提示：密码强度极高(啊~~，暴力破解你的密码至少要1万年以上)</span><br>';
//                    }
//                }
//                    echo $type[0];
//                    echo implode('.',$type);
                exit();
            }
            /**
             *
             * @检测密码强度
             * @param string $password
             * @return int
             * @edit www.jbxue.com
             */
            function testPassword($password)
            {
                if ( strlen( $password ) == 0 )
                {
                    return 1;
                }
                $strength = 0;
                /*** get the length of the password ***/
                $length = strlen($password);
                /*** check if password is not all lower case ***/
                if(strtolower($password) != $password)
                {
                    $strength += 1;
                }
                /*** check if password is not all upper case ***/
                if(strtoupper($password) == $password)
                {
                    $strength += 1;
                }
                /*** check string length is 8 -15 chars ***/
                if($length >= 8 && $length <= 15)
                {
                    $strength += 1;
                }
                /*** check if lenth is 16 - 35 chars ***/
                if($length >= 16 && $length <=35)
                {
                    $strength += 2;
                }
                /*** check if length greater than 35 chars ***/
                if($length > 35)
                {
                    $strength += 3;
                }
                /*** get the numbers in the password ***/
                preg_match_all('/[0-9]/', $password, $numbers);
                $strength += count($numbers[0]);
                /*** check for special chars ***/
                preg_match_all('/[|!@#$%&*\/=?,;.:\-_+~^\\\]/', $password, $specialchars);
                $strength += sizeof($specialchars[0]);
                /*** get the number of unique chars ***/
                $chars = str_split($password);
                $num_unique_chars = sizeof( array_unique($chars) );
                $strength += $num_unique_chars * 2;
                /*** strength is a number 1-10; ***/
                $strength = $strength > 99 ? 99 : $strength;
                $strength = floor($strength / 10 + 1);
                return $strength;
            }
            /*** 调用示例 ***/
            ?>
        </div>
    </div>
</div>
</body>
</html>