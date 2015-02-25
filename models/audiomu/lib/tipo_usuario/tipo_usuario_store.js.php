<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeTipo_usuario = new Ext.data.JsonStore({
	url:'proceso/tipo_usuario/'
	,root:'datos'
	,sortInfo:{field:'tipo_usuario_id',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'tipo_usuario_id', type:'float'},
		{name:'tipo_usuario_nombre', type:'string'}
	]
});
var comboTipo_usuario = new Ext.form.ComboBox({
	hiddenName:'tipo_usuario'
	,id:modulo+'comboTipo_usuario'
	,fieldLabel:'<?php print _TIPO_USUARIO; ?>'
	,store:storeTipo_usuario
	,valueField:'tipo_usuario_id'
	,displayField:'tipo_usuario_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmTipo_usuario = new Ext.grid.ColumnModel({
	columns:[
		{xtype:'numbercolumn', header:'<?php print _TIPO_USUARIO_ID; ?>', align:'right', hidden:false, dataIndex:'tipo_usuario_id'},
		{header:'<?php print _TIPO_USUARIO_NOMBRE; ?>', align:'left', hidden:false, dataIndex:'tipo_usuario_nombre'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbTipo_usuario = new Ext.Toolbar();

var gridTipo_usuario = new Ext.grid.GridPanel({
	store:storeTipo_usuario
	,id:modulo+'gridTipo_usuario'
	,colModel:cmTipo_usuario
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeTipo_usuario, displayInfo:true})
	,tbar:tbTipo_usuario
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formTipo_usuario = new Ext.FormPanel({
	baseCls:'x-panel-mc'
	,method:'POST'
	,baseParams:{accion:'act'}
	,autoWidth:true
	,autoScroll:true
	,trackResetOnLoad:true
	,monitorValid:true
	,bodyStyle:'padding:15px;'
	,reader: new Ext.data.JsonReader({
		root:'datos'
		,totalProperty:'total'
		,fields:[
			{name:'tipo_usuario_id', mapping:'tipo_usuario_id', type:'float'},
			{name:'tipo_usuario_nombre', mapping:'tipo_usuario_nombre', type:'string'}
		]
	})
	,items:[{
		xtype:'fieldset'
		,title:'Information'
		,layout:'column'
		,defaults:{
			columnWidth:0.33
			,layout:'form'
			,labelAlign:'top'
			,border:false
			,xtype:'panel'
			,bodyStyle:'padding:0 18px 0 0'
		}
		,items:[{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'tipo_usuario_id'
				,fieldLabel:'<?php print _TIPO_USUARIO_ID; ?>'
				,id:modulo+'tipo_usuario_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'tipo_usuario_nombre'
				,fieldLabel:'<?php print _TIPO_USUARIO_NOMBRE; ?>'
				,id:modulo+'tipo_usuario_nombre'
				,allowBlank:false
			}]
		}]
	}]
});
