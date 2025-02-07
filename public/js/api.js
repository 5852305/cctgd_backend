window.curr=1;
window.limit=10;
window.tableList=[];
function error(err) {
    console.log(err.response.data);
    if (err.response.data.info) {
        alert(err.response.data.info);
    }
    if (err.response.data.errors != undefined) {
        $.each(err.response.data.errors, function (name, errMsg) {
            var names = name.split('.');
            //  console.log(names[0]);
            if (names.length > 1) {
                alert(errMsg[0]);
            } else {
                alert(errMsg);
            }
        });
    } else {
        alert(err.response.data.message);
    }
}
function del(ids,obj) {
    var id=ids.join(",");
    axios({
        method:"delete",
        url:api.category.delete.replace(":ids",id),
    }).then(function(res){
        alert(res.data.msg);
        obj.del()
    }).catch(function(err){
        error(err);
    })
}
var api = {
    "category": {
        'list':'/api/category',//分类列表 get
        'info':'/api/category/:id',//分类详情 get
        'create':'/api/category',//分类新增 post
        'update':'/api/category/:id',//分类修改 put
        'delete':'/api/category/:ids',//分类删除 get
    },
    "upload": {
        'image':'/api/uploadImages',//上传图片 post
    },



   /*-----------------------------轮播图-----------------------------*/
'banner':{
'list':'/api/banner', //轮播图列表 get
'info':'/api/banner/:id',//轮播图.详情 get
'create':'/api/banner',//轮播图.新增 post
'update':'/api/banner/:id',//轮播图.修改 put
'update':'/api/banner/:ids',//轮播图.删除 get
},
   /*-----------------------------轮播图-----------------------------*/
'banners':{
'list':'/api/banners', //轮播图列表 get
'info':'/api/banners/:id',//轮播图.详情 get
'create':'/api/banners',//轮播图.新增 post
'update':'/api/banners/:id',//轮播图.修改 put
'update':'/api/banners/:ids',//轮播图.删除 get
},/*-*/
}
