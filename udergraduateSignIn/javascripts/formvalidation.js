/**
 * Created by 10155 on 2017/7/9.
 */
function FormValidation(pwd){
    var inputs,tooltips,btn,pswTwo;//pswTwo储存的是第一次输入的密码 用于后面和第二次输入的密码比较

    //储存状态 用于最后提交时验证
    var flag = {
        name:false,
        psw:false,
        pswTwo:false,
        email:false,
        phonenumer:true
    }

    //设置提示的样式
    var TooltipObj = {
        init:{
            message:["必填，长度为12-16个数字","必填，密码长度为6-16个字符（英文）","必填，请再次输入密码","必填，请输入手机号","必填，请输入验证码","两次密码不同"]
        },
        //通用提示信息
        comMessage:{
            empty:{
                message:"不能为空"
            },
            success:{
                message:"格式正确"
            },
            fail:{
                message:"格式不正确"
            },
            twoPsw:{
                message:"两次密码相同"
            },
            identifyingCode:{
                message:"验证码不对"
            }
        },
        style:{
            init:"#a6a6a6",
            success:"#68ba56",
            fail:"#fc0303",
            empty:"#fc0303",
            twoPsw:"#68ba56"
        }
    };

    //提示信息显示
    this.tooltipsShow = function(type,num,twoPsw){
        if(twoPsw){
            if(type === null){  //点击输入框时显示输入格式的要求的样式
                inputs[num].style.borderColor = TooltipObj.style.init;
                tooltips[num].innerText = TooltipObj.init.message[num];
                tooltips[num].style.color = TooltipObj.style.init;
            }else{
                //这里type的值为empty,true,false
                inputs[num].style.borderColor = TooltipObj.style[type];
                tooltips[num].innerText = TooltipObj.comMessage[type].message;
                tooltips[num].style.color = TooltipObj.style[type];
            }
        }else{//这里针对第二次输入密码不同时的样式
            inputs[num].style.borderColor = TooltipObj.style.false;
            tooltips[num].innerText = TooltipObj.init.message[5];
            tooltips[num].style.color = TooltipObj.style.false;
        }

    };


    //验证输入内容的合法性
    this.validation = function(num){
        var _self = this;
        switch(num){
            case 0:(function(){
                var regNum = /^[0-9]+$/
                var textValue = inputs[0].value //获取输入框的值
                var allLength = textValue.length  //字数总长度
                if(textValue !="学号"){
                    if(allLength >= 12 && allLength <=16 && regNum.test(textValue)){
                        _self.tooltipsShow("success",0,true);
                        flag.name = true;
                    }else{
                        _self.tooltipsShow("fail",0,true);
                        flag.name = false;
                    }
                }else{
                    _self.tooltipsShow("empty",0,true);
                    flag.name = false;
                }
            })();break;
            case 1:(function(){
                var regEnglish = /([\x00-\xff])/g,
                    textValue = inputs[1].value,
                    englishLength;
                textValue.match(regEnglish) ? englishLength = (textValue.match(regEnglish)).length : englishLength = 0;
                if(textValue != "密码"){
                    if(englishLength >= 6 && englishLength <= 16){
                        pswTwo = textValue;
                        _self.tooltipsShow("success",1,true);
                        flag.psw = true;
                    }else{
                        _self.tooltipsShow("fail",1,true);
                        flag.psw = false;
                    }
                }else{
                    _self.tooltipsShow("empty",1,true);
                    flag.psw = false;
                }
            })();break;
            case 2:(function(){
                var textValue = inputs[2].value;
                if(textValue !== "确认密码"){
                    if(textValue === pswTwo){
                        _self.tooltipsShow("twoPsw",2,true);
                        flag.pswTwo = true;
                    }else{
                        _self.tooltipsShow(null,2,false);
                        flag.pswTwo = false;
                    }
                }else{
                    _self.tooltipsShow("empty",2,true);
                    flag.pswTwo = false;
                }
            })();break;
            case 3:(function(){
                var regEmail=/^1[3|5|8]\d{9}$//*/^\w+@\w+\.com(\.cn)?$/i*/,
                    textValue = inputs[3].value;
                if(textValue !== "手机号"){
                    if(regEmail.test(textValue)){
                        _self.tooltipsShow("success",3,true);
                        flag.email = true;
                    }else{
                        _self.tooltipsShow("fail",3,true);
                        flag.email = false;
                    }
                }else{
                    _self.tooltipsShow("empty",3,true);
                    flag.email = false;
                }
            })();break;
            case 4:(function(){
                var regPhone = /^1[3|5|8]\d{9}$/,
                    textValue = inputs[4].value;
               /* if(textValue !== "验证码"){
                    if(regPhone.test(textValue)){
                        _self.tooltipsShow("success",4,true);
                        flag.phonenumer = true;
                    }else{
                        _self.tooltipsShow("fail",4,true);
                        flag.phonenumer = false;
                    }
                }else{
                    _self.tooltipsShow("empty",4,true);
                    flag.phonenumer = false;
                }*/
            })();break;
        }
    };

    //提交
    this.validationAll = function(event){
        var isOk = true;
        for(var attribute in flag){
            if(!flag[attribute]) isOk = false;
        }
        if(isOk){
           inputs[1].value = hex_md5(inputs[1].value)
        }else{
        	event.preventDefault()
            alert("填写信息不全或错误");
        }
    };

    //绑定事件
    this.addListener = function(){
        var _self = this;
        for(var i = 0;i < inputs.length - 1;i++){
            (function(num){
                inputs[num].onfocus = function(){
                    _self.tooltipsShow(null,num,true);
                };
                inputs[num].onblur = function(){
                    _self.validation(num);
                };
            })(i);
        }

        document.getElementById("submit").onclick = function(e){
            _self.validationAll(e);
        }
    };

    //初始化
    this.init = function(){
        btn = document.getElementById("submit");
        inputs = document.getElementsByClassName("input");
        tooltips = document.getElementsByClassName("tooltips");

        this.addListener();
    }
}
