/*1.version:1.0,
 *2.基于Jquery的分页插件,
 *3.传输的数据类型默认为JSON
 *4.ajax提交方式默认为POST
 *5.使用本插件前请先引入Jquery
 */

var Paging = function (option) {
    var pagingThis,//记录上一页被点击的元素
        paging,  //获取每一个li标签
        currentPage = 1  //当前页

    //绘制分页按钮的样式
    this.show = function () {
        var _num = 0
        if (option.pages >= option.displayPage) {
            _num = option.displayPage
        } else {
            _num = option.pages
        }
        var html = "<li>首页</li>" + "<li>上一页</li>"
        for (var i = 1; i <= _num; i++) {
            html += "<li >" + i + "</li>"
        }
        html += "<li>...</li>" + "<li>下一页</li>" + "<li>尾页</li>"
        $(option.id).html(html)
        paging = $(option.id + " > li")
        $(paging[_num + 3]).css("width", "66px")
        $(paging[_num + 4]).css("width", "50px")
        pagingThis = paging[2]
    }
    
    //页数按钮的样式的改变
    this.changeStyle = function (type, arg1) {
    	//type:取值为“+”或者“-”,“+”代表下一页,"-"代表上一页；arg1：代表点击的是首页还是尾页
        var _index = 0,  //索引
            _num = 0
            
        //上一页和下一页的样式的改变
        if (option.pages >= option.displayPage) {
            if (type === "+") {
                if (pagingThis.innerText !== "" + option.displayPage && parseInt(pagingThis.innerText) < option.displayPage) {
                    _index = $(pagingThis).index() + 1
                } else {
                    _num = 1
                }
            } else if (type === "-") {
                if (pagingThis !== paging[2]) {
                    _index = $(pagingThis).index() - 1
                } else if (paging[2].innerText !== "1" && pagingThis === paging[2]) {
                    _num = -1
                }
            }
        } else {
            if (type === "+") {
                if (pagingThis.innerText !== "" + option.displayPage && parseInt(pagingThis.innerText) < option.displayPage) {
                    _index = $(pagingThis).index() + 1
                }
            } else if (type === "-") {
                if (paging[2].innerText !== "1" && pagingThis !== paging[2]) {
                    _index = $(pagingThis).index() - 1
                }
            }
        }
        if (_index !== 0) {
            $(pagingThis).css({"color": "black", "background": "rgba(0, 0, 0, .1)"})
            pagingThis = paging[_index]
            $(pagingThis).css({"color": "white", "background": "rgba(0, 0, 0, .3)"})
        } else {
            for (var i = 2; i < option.displayPage + 2; i++) {
                paging[i].innerText = parseInt(paging[i].innerText) + _num
            }
        }
        index = 0
        
        //首页和尾页的样式改变
        if (arg1 !== undefined) {
            $(pagingThis).css({"color": "black", "background": "rgba(0, 0, 0, .1)"})
            if (arg1 === 1) {
                for (var i = 0; i < paging.length - 5; i++) {
                    paging[i + 2].innerText = i + 1
                }
                pagingThis = paging[2]
            } else {
                for (var i = paging.length - 6; i >= 0; i--) {
                    paging[i + 2].innerText = arg1--
                }
                pagingThis = paging[paging.length - 4]

            }
            $(pagingThis).css({"color": "white", "background": "rgba(0, 0, 0, .3)"})
        }

    }

    //绑定事件
    this.addListener = function () {
        var _self = this
        paging.on("click", function () {
                if (option.pages > 1) {
                    var _text = this.innerText
                    if (/\d/.test(_text)) {
                        currentPage = parseInt(_text)
                        $(pagingThis).css({"color": "black", "background": "rgba(0, 0, 0, .1)"});
                        $(this).css({"color": "white", "background": "rgba(0, 0, 0, .3)"});
                        pagingThis = this
                    } else {
                        if (_text === "上一页") {
                            if (currentPage > 1) {
                                --currentPage
                                _self.changeStyle("-")
                            }
                        } else if (_text === "下一页") {
                            if (currentPage < option.pages) {
                                ++currentPage
                                _self.changeStyle("+")
                            }
                        } else if (_text === "首页") {
                            if (currentPage > 1) {
                                currentPage = 1
                                _self.changeStyle("", 1)
                            }
                        } else if (_text === "尾页") {
                            if (currentPage < option.pages) {
                                currentPage = option.pages
                                _self.changeStyle("", option.pages)
                            }
                        }
                    }
                }
                _self.drawHtml(currentPage)
            }
        )
    }

    //将获取的数据显示到html中
    this.drawHtml = function(currentPage){
        $.ajax({
            type: "post",
            url: 'api.php',
            dataType: 'json',
            data: {status:"select",type:"attendancerecord",currentPage:currentPage},
            success: function (data) {
                var html = "<tr><td>时间</td><td>地点</td><td>状态</td><td>查看</td></tr>",
                    pages = data.length
                for (var i = 0; i < pages - 1; i++) {
                    var state = data[i]['state']
                    html += "<tr><td>" + data[i]['time'] + "</td><td>" + data[i]['adress'] + "</td>"
                    if (state === "1") {
                        html += "<td class='normal'>正常"
                    } else if (state === "2") {
                        html += "<td class='late'>迟到"
                    } else if (state === "3") {
                        html += "<td class='leave'>请假"
                    }
                    html += "</td><td>查看详情</td></tr>"
                }
                $("#attendance-record-content").html(html)
                for(var j = 0;j<pages-1;j++){

                }
            },
            error: function () {
                alert("error");
            }
        })
    }

    this.init = function () {
        this.show()
        this.addListener()
    }
    this.init()
}
