window.curr=1;
window.limit=10;
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
    }
}
