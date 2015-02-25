<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeFrecuentes = new Ext.data.JsonStore({
	url:'proceso/frecuentes/'
	,root:'datos'
	,sortInfo:{field:'frecuentes_id',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'frecuentes_id', type:'float'},
		{name:'frecuentes_pregunta', type:'string'},
		{name:'frecuentes_respuesta', type:'string'}
	]
});
var comboFrecuentes = new Ext.form.ComboBox({
	hiddenName:'frecuentes'
	,id:modulo+'comboFrecuentes'
	,fieldLabel:'<?php print _FRECUENTES; ?>'
	,store:storeFrecuentes
	,valueField:'frecuentes_id'
	,displayField:'frecuentes_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmFrecuentes = new Ext.grid.ColumnModel({
	columns:[
		{xtype:'numbercolumn', header:'<?php print _FRECUENTES_ID; ?>', align:'right', hidden:false, dataIndex:'frecuentes_id'},
		{header:'<?php print _FRECUENTES_PREGUNTA; ?>', align:'left', hidden:false, dataIndex:'frecuentes_pregunta'},
		{header:'<?php print _FRECUENTES_RESPUESTA; ?>', align:'left', hidden:false, dataIndex:'frecuentes_respuesta'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbFrecuentes = new Ext.Toolbar();

var gridFrecuentes = new Ext.grid.GridPanel({
	store:storeFrecuentes
	,id:modulo+'gridFrecuentes'
	,colModel:cmFrecuentes
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeFrecuentes, displayInfo:true})
	,tbar:tbFrecuentes
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formFrecuentes = new Ext.FormPanel({
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
			{name:'frecuentes_id', mapping:'frecuentes_id', type:'float'},
			{name:'frecuentes_pregunta', mapping:'frecuentes_pregunta', type:'string'},
			{name:'frecuentes_respuesta', mapping:'frecuentes_respuesta', type:'string'}
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
				,name:'frecuentes_id'
				,fieldLabel:'<?php print _FRECUENTES_ID; ?>'
				,id:modulo+'frecuentes_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'frecuentes_pregunta'
				,fieldLabel:'<?php print _FRECUENTES_PREGUNTA; ?>'
				,id:modulo+'frecuentes_pregunta'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'frecuentes_respuesta'
				,fieldLabel:'<?php print _FRECUENTES_RESPUESTA; ?>'
				,id:modulo+'frecuentes_respuesta'
				,allowBlank:false
			}]
		}]
	}]
});
