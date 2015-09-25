//弹窗提示信息
function alertLayer(msg){
    layer.open({
        content:msg,
        shade:false,
        style:'background-color:#666;color:#fff;text-align:center;',
        time:1.2
    });
}
//询问框，成功执行fun1函数，失败执行fun2函数
function confirmLayer(msg,fun1,fun2){
    layer.open({
        content:msg,
        style:'text-align:center;font-size:16px;',
        btn:['确认','取消'],
        shadeClose:false,
        yes:
            fun1,
        no:
            fun2
    });
}
//加载动画，par为1显示，par为2关闭
function loadLayer(status){
    if(status==1){//显示加载
        layer.open({
            content:'&nbsp;',
            className: 'loadingBox',
            shadeClose:false
        });
        $('.laymshade').css('background-color','rgba(255,255,255,0.3)');
    }else{//关闭加载
        $('.laymshade').css('background-color','rgba(0,0,0,.5)');
        layer.closeAll();
    }
}