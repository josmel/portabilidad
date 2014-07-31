/*=========================================================================================
 *@ListModules: Listado de todos los Modulos asociados al portal
 **//*===================================================================================*/
yOSON.AppSchema.modules = {
    'admin': {
        controllers:{     
             'consulta-previa':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/admin/consulta-previa/list","table":"tdAction4"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },
             'solicitud-consulta-previa':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/admin/solicitud-consulta-previa/list","table":"tdAction6"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },
             'solicitud-portabilidad-cedente':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/admin/solicitud-portabilidad-cedente/list","table":"tdAction6"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },
            'solicitud-portabilidad':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/admin/solicitud-portabilidad/list","table":"tdAction4"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },
            'customer':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/admin/customer/list","table":"tdAction5"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },
            'reservation':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/reservation/list","table":"tdAction5"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    '/admin/reservation/tips':function(){
                        yOSON.AppCore.runModule('crudTips');
                    },
                    '/admin/reservation/empresa':function(){
                        yOSON.AppCore.runModule('crudEmpresa');
                    },
                     '/admin/reservation/activities':function(){
                        yOSON.AppCore.runModule('crudActivityes');
                    },
                   '/admin/reservation/services':function(){
                        yOSON.AppCore.runModule('crudServices');
                    },
                    '/admin/reservation/access':function(){
                        yOSON.AppCore.runModule('crudAcces');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },'featured':{
                actions : {
                    'index' : function(){
                        yOSON.AppCore.runModule('dataTable',{"url":"/featured/list","table":"tdAction"});
                        yOSON.AppCore.runModule('actionDel');
                    },
                    'byDefault':function(){}
                },
                allActions:function(){}
            },
                    
            byDefault : function(){},
            allActions: function(){}
        },
        byDefault : function(){},
        allControllers : function(){}
    },
    byDefault : function(){},
    allModules : function(oMCA){}
};