<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeSamples = new Ext.data.JsonStore({
	url:'proceso/samples/'
	,root:'datos'
	,sortInfo:{field:'samples_id',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'samples_id', type:'float'},
		{name:'samples_nombre', type:'string'},
		{name:'samples_archivo', type:'string'}
	]
});
var comboSamples = new Ext.form.ComboBox({
	hiddenName:'samples'
	,id:modulo+'comboSamples'
	,fieldLabel:'<?php print _SAMPLES; ?>'
	,store:storeSamples
	,valueField:'samples_id'
	,displayField:'samples_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmSamples = new Ext.grid.ColumnModel({
	columns:[
		{xtype:'numbercolumn', header:'<?php print _SAMPLES_ID; ?>', align:'right', hidden:false, dataIndex:'samples_id'},
		{header:'<?php print _SAMPLES_NOMBRE; ?>', align:'left', hidden:false, dataIndex:'samples_nombre'},
		{header:'<?php print _SAMPLES_ARCHIVO; ?>', align:'left', hidden:false, dataIndex:'samples_archivo'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbSamples = new Ext.Toolbar();

var gridSamples = new Ext.grid.GridPanel({
	store:storeSamples
	,id:modulo+'gridSamples'
	,colModel:cmSamples
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeSamples, displayInfo:true})
	,tbar:tbSamples
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formSamples = new Ext.FormPanel({
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
			{name:'samples_id', mapping:'samples_id', type:'float'},
			{name:'samples_nombre', mapping:'samples_nombre', type:'string'},
			{name:'samples_archivo', mapping:'samples_archivo', type:'string'}
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
				,name:'samples_id'
				,fieldLabel:'<?php print _SAMPLES_ID; ?>'
				,id:modulo+'samples_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'samples_nombre'
				,fieldLabel:'<?php print _SAMPLES_NOMBRE; ?>'
				,id:modulo+'samples_nombre'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'samples_archivo'
				,fieldLabel:'<?php print _SAMPLES_ARCHIVO; ?>'
				,id:modulo+'samples_archivo'
				,allowBlank:false
			}]
		}]
	}]
});
