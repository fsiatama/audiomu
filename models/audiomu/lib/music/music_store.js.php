<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeMusic = new Ext.data.JsonStore({
	url:'proceso/music/'
	,root:'datos'
	,sortInfo:{field:'music_id',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'music_id', type:'float'},
		{name:'music_nombre', type:'string'},
		{name:'music_archivo', type:'string'}
	]
});
var comboMusic = new Ext.form.ComboBox({
	hiddenName:'music'
	,id:modulo+'comboMusic'
	,fieldLabel:'<?php print _MUSIC; ?>'
	,store:storeMusic
	,valueField:'music_id'
	,displayField:'music_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmMusic = new Ext.grid.ColumnModel({
	columns:[
		{xtype:'numbercolumn', header:'<?php print _MUSIC_ID; ?>', align:'right', hidden:false, dataIndex:'music_id'},
		{header:'<?php print _MUSIC_NOMBRE; ?>', align:'left', hidden:false, dataIndex:'music_nombre'},
		{header:'<?php print _MUSIC_ARCHIVO; ?>', align:'left', hidden:false, dataIndex:'music_archivo'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbMusic = new Ext.Toolbar();

var gridMusic = new Ext.grid.GridPanel({
	store:storeMusic
	,id:modulo+'gridMusic'
	,colModel:cmMusic
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeMusic, displayInfo:true})
	,tbar:tbMusic
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formMusic = new Ext.FormPanel({
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
			{name:'music_id', mapping:'music_id', type:'float'},
			{name:'music_nombre', mapping:'music_nombre', type:'string'},
			{name:'music_archivo', mapping:'music_archivo', type:'string'}
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
				,name:'music_id'
				,fieldLabel:'<?php print _MUSIC_ID; ?>'
				,id:modulo+'music_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'music_nombre'
				,fieldLabel:'<?php print _MUSIC_NOMBRE; ?>'
				,id:modulo+'music_nombre'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'music_archivo'
				,fieldLabel:'<?php print _MUSIC_ARCHIVO; ?>'
				,id:modulo+'music_archivo'
				,allowBlank:false
			}]
		}]
	}]
});
